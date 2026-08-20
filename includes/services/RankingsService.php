<?php
declare(strict_types=1);

final class RankingsService
{
    public function __construct(private PDO $pdo) {}

    private function setting(string $key,int $default=0): int
    {
        $s=$this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');$s->execute([$key]);$v=$s->fetchColumn();return $v===false?$default:max(0,(int)$v);
    }

    private function event(int $playerId,string $type,array $payload): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');$s->execute([$playerId,$type,'ranking',null,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }

    private function componentRows(): array
    {
        $sql="SELECT p.id,p.display_name,p.username,
            COALESCE(r.attack_units,0)+COALESCE(r.defense_units,0)+((COALESCE(r.super_attack_units,0)+COALESCE(r.super_defense_units,0))*10)+(COALESCE(r.unit_production,0)*100) military_score,
            ((COALESCE(r.naquadah,0)+COALESCE(r.banked_naquadah,0)) DIV 1000)+((COALESCE(r.metal,0)+COALESCE(r.crystal,0)) DIV 10000) economy_score,
            COALESCE(r.spies,0)+COALESCE(r.anti_spies,0) covert_score,
            COALESCE((SELECT SUM(pt.level*t.effect_value) FROM player_technologies pt JOIN technologies t ON t.technology_key=pt.technology_key WHERE pt.player_id=p.id),0) technology_score,
            COALESCE(gr.glory,p.glory,0) glory_score,
            0 penalty_score
          FROM players p JOIN player_resources r ON r.player_id=p.id LEFT JOIN glory_reputation gr ON gr.player_id=p.id";
        $rows=$this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);foreach($rows as &$row){$row['military_score']=(int)$row['military_score'];$row['economy_score']=(int)$row['economy_score'];$row['covert_score']=(int)$row['covert_score'];$row['technology_score']=(int)$row['technology_score'];$row['glory_score']=(int)$row['glory_score'];$row['penalty_score']=(int)$row['penalty_score'];$row['overall_score']=$row['economy_score']+$row['military_score']+$row['covert_score']+$row['technology_score']+$row['glory_score']-$row['penalty_score'];}unset($row);usort($rows,static fn(array $a,array $b):int=>($b['overall_score']<=>$a['overall_score'])?:((int)$a['id']<=>(int)$b['id']));foreach($rows as $i=>&$row){$row['rank_position']=$i+1;}unset($row);return $rows;
    }

    public function rankings(int $viewerId,int $limit=100): array
    {
        if($viewerId<1)throw new InvalidArgumentException('Invalid rankings request.');$limit=max(1,min(200,$limit));$rows=$this->pdo->query('SELECT r.rank_position,r.player_id,p.display_name,p.username,r.overall_score,r.military_score,r.economy_score,r.covert_score,r.technology_score,r.glory_score,r.penalty_score,r.updated_at FROM rankings r JOIN players p ON p.id=r.player_id ORDER BY r.rank_position IS NULL,r.rank_position,r.player_id LIMIT '.(int)$limit)->fetchAll(PDO::FETCH_ASSOC);return ['state'=>$rows?'ready':'empty','rows'=>$rows,'viewer_id'=>$viewerId,'limit'=>$limit,'formula'=>'ranking score = economy + military + technology + glory − penalties','fields'=>['display_name','rank_position','overall_score','military_score','economy_score','covert_score','technology_score','glory_score','penalty_score'],'states'=>['loading','ready','empty','error']];
    }

    public function refresh(int $playerId): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid ranking refresh request.');$this->pdo->beginTransaction();try{$cooldown=$this->setting('ranking_refresh_cooldown_seconds');$c=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='ranking_refresh' FOR UPDATE");$c->execute([$playerId]);$available=$c->fetchColumn();if($available!==false&&new DateTimeImmutable((string)$available)>new DateTimeImmutable('now'))throw new RuntimeException('Rankings refresh is on cooldown.');$rows=$this->componentRows();if(!$rows)throw new RuntimeException('No ranking data available.');$up=$this->pdo->prepare('INSERT INTO rankings(player_id,overall_score,military_score,economy_score,covert_score,technology_score,glory_score,penalty_score,rank_position) VALUES(?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE overall_score=VALUES(overall_score),military_score=VALUES(military_score),economy_score=VALUES(economy_score),covert_score=VALUES(covert_score),technology_score=VALUES(technology_score),glory_score=VALUES(glory_score),penalty_score=VALUES(penalty_score),rank_position=VALUES(rank_position)');foreach($rows as $row)$up->execute([(int)$row['id'],$row['overall_score'],$row['military_score'],$row['economy_score'],$row['covert_score'],$row['technology_score'],$row['glory_score'],$row['penalty_score'],$row['rank_position']]);$snap=$this->pdo->prepare('INSERT INTO rank_snapshots(player_id,snapshot_date,overall_score,military_score,economy_score,covert_score,technology_score,glory_score,penalty_score,rank_position) VALUES(?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE overall_score=VALUES(overall_score),military_score=VALUES(military_score),economy_score=VALUES(economy_score),covert_score=VALUES(covert_score),technology_score=VALUES(technology_score),glory_score=VALUES(glory_score),penalty_score=VALUES(penalty_score),rank_position=VALUES(rank_position)');$date=(new DateTimeImmutable('now'))->format('Y-m-d');foreach($rows as $row)$snap->execute([(int)$row['id'],$date,$row['overall_score'],$row['military_score'],$row['economy_score'],$row['covert_score'],$row['technology_score'],$row['glory_score'],$row['penalty_score'],$row['rank_position']]);if($cooldown>0){$next=(new DateTimeImmutable('now'))->modify('+'.$cooldown.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$playerId,'ranking_refresh',$next]);}$this->event($playerId,'rankings_refreshed',['rows'=>count($rows),'snapshot_date'=>$date,'cooldown_seconds'=>$cooldown]);$this->pdo->commit();return ['state'=>'success','rows'=>$rows,'snapshot_date'=>$date,'cooldown_seconds'=>$cooldown,'formula'=>'ranking score = economy + military + technology + glory − penalties'];}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function publicProfile(int $viewerId,int $targetId): array
    {
        if($viewerId<1||$targetId<1)throw new InvalidArgumentException('Invalid public profile request.');$s=$this->pdo->prepare('SELECT p.id,p.display_name,p.username,p.title,p.rank_level,r.rank_position,r.overall_score,r.military_score,r.economy_score,r.covert_score,r.technology_score,r.glory_score FROM players p LEFT JOIN rankings r ON r.player_id=p.id WHERE p.id=?');$s->execute([$targetId]);$row=$s->fetch(PDO::FETCH_ASSOC);if(!$row)throw new RuntimeException('Public commander profile not found.');return ['state'=>'ready','profile'=>['id'=>(int)$row['id'],'display_name'=>$row['display_name'],'username'=>$row['username'],'title'=>$row['title'],'rank_level'=>(int)$row['rank_level'],'rank_position'=>$row['rank_position']===null?null:(int)$row['rank_position'],'overall_score'=>(int)($row['overall_score']??0),'military_score'=>(int)($row['military_score']??0),'economy_score'=>(int)($row['economy_score']??0),'covert_score'=>(int)($row['covert_score']??0),'technology_score'=>(int)($row['technology_score']??0),'glory_score'=>(int)($row['glory_score']??0)]];
    }
}
