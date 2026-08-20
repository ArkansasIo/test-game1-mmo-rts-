<?php
declare(strict_types=1);

final class SpyLogService
{
    public function __construct(private PDO $pdo) {}

    public function snapshot(int $playerId): array
    {
        $missions=[];
        $q=$this->pdo->prepare("SELECT cm.id,cm.mission_type,cm.agents_sent,cm.success,cm.detected,cm.result_text,cm.created_at,COALESCE(p.display_name,p.username) AS target_name FROM covert_missions cm JOIN players p ON p.id=cm.defender_id WHERE cm.attacker_id=? ORDER BY cm.created_at DESC LIMIT 20");$q->execute([$playerId]);
        foreach($q->fetchAll() as $r)$missions[]=['id'=>(int)$r['id'],'source'=>'covert_missions','type'=>$r['mission_type'],'agents'=>(int)$r['agents_sent'],'success'=>(bool)$r['success'],'detected'=>(bool)$r['detected'],'result'=>$r['result_text'],'target'=>$r['target_name'],'created_at'=>$r['created_at'],'classification'=>'MISSION'];
        $q=$this->pdo->prepare("SELECT sm.id,sm.mission_type,sm.agents_sent,sm.success,sm.detected,sm.agent_losses,sm.result_text,sm.created_at,COALESCE(p.display_name,p.username) AS target_name FROM spy_missions sm JOIN players p ON p.id=sm.defender_id WHERE sm.attacker_id=? ORDER BY sm.created_at DESC LIMIT 20");$q->execute([$playerId]);
        foreach($q->fetchAll() as $r)$missions[]=['id'=>(int)$r['id'],'source'=>'spy_missions','type'=>$r['mission_type'],'agents'=>(int)$r['agents_sent'],'success'=>(bool)$r['success'],'detected'=>(bool)$r['detected'],'losses'=>(int)$r['agent_losses'],'result'=>$r['result_text'],'target'=>$r['target_name'],'created_at'=>$r['created_at'],'classification'=>'CLASSIFIED'];
        usort($missions,fn(array $a,array $b)=>strcmp((string)$b['created_at'],(string)$a['created_at']));
        $reports=[];$q=$this->pdo->prepare("SELECT ir.id,ir.report_type,ir.payload,ir.seen_at,ir.created_at,COALESCE(p.display_name,p.username) AS target_name FROM intelligence_reports ir JOIN players p ON p.id=ir.target_player_id WHERE ir.player_id=? ORDER BY ir.created_at DESC LIMIT 20");$q->execute([$playerId]);
        foreach($q->fetchAll() as $r){$payload=json_decode((string)$r['payload'],true);$reports[]=['id'=>(int)$r['id'],'type'=>$r['report_type'],'target'=>$r['target_name'],'payload'=>is_array($payload)?$payload:[],'classification'=>'CLASSIFIED','seen_at'=>$r['seen_at'],'created_at'=>$r['created_at'],'read'=>$r['seen_at']!==null];}
        return ['missions'=>$missions,'reports'=>$reports,'mission_count'=>count($missions),'report_count'=>count($reports),'unread'=>count(array_filter($reports,fn(array $r):bool=>!$r['read'])),'formula'=>'report visibility = recipient ownership + classification + read status','states'=>['loading','ready','empty','success','error']];
    }

    public function markRead(int $playerId,int $reportId): void
    {
        $this->pdo->beginTransaction();try{$s=$this->pdo->prepare('SELECT id FROM intelligence_reports WHERE id=? AND player_id=? FOR UPDATE');$s->execute([$reportId,$playerId]);if(!$s->fetch())throw new RuntimeException('Report not found or not owned.');$this->pdo->prepare('UPDATE intelligence_reports SET seen_at=COALESCE(seen_at,NOW()) WHERE id=? AND player_id=?')->execute([$reportId,$playerId]);$this->pdo->commit();}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
