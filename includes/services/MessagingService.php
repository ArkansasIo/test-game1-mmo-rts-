<?php
declare(strict_types=1);

final class MessagingService
{
    public function __construct(private PDO $pdo) {}

    private function setting(string $key,int $default=0): int
    {
        $s=$this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');$s->execute([$key]);$v=$s->fetchColumn();return $v===false?$default:max(0,(int)$v);
    }

    private function event(int $playerId,string $type,?int $entityId,array $payload): void
    {
        $s=$this->pdo->prepare('INSERT INTO game_events(player_id,event_type,entity_type,entity_id,payload) VALUES(?,?,?,?,?)');$s->execute([$playerId,$type,'message',$entityId,json_encode($payload,JSON_THROW_ON_ERROR)]);
    }

    public function inbox(int $playerId,int $limit=100): array
    {
        if($playerId<1)throw new InvalidArgumentException('Invalid messaging request.');$limit=max(1,min(200,$limit));$s=$this->pdo->prepare("SELECT m.id,m.sender_id,m.recipient_id,m.subject,m.body,m.read_at,m.created_at,COALESCE(p.display_name,p.username) sender_name FROM messages m JOIN players p ON p.id=m.sender_id WHERE m.recipient_id=? AND NOT EXISTS (SELECT 1 FROM blacklists b WHERE b.player_id=? AND b.blocked_player_id=m.sender_id) ORDER BY m.created_at DESC,m.id DESC LIMIT {$limit}");$s->execute([$playerId,$playerId]);$inbox=$s->fetchAll(PDO::FETCH_ASSOC);$s=$this->pdo->prepare("SELECT m.id,m.sender_id,m.recipient_id,m.subject,m.body,m.read_at,m.created_at,COALESCE(p.display_name,p.username) recipient_name FROM messages m JOIN players p ON p.id=m.recipient_id WHERE m.sender_id=? AND NOT EXISTS (SELECT 1 FROM blacklists b WHERE b.player_id=? AND b.blocked_player_id=m.recipient_id) ORDER BY m.created_at DESC,m.id DESC LIMIT {$limit}");$s->execute([$playerId,$playerId]);$sent=$s->fetchAll(PDO::FETCH_ASSOC);$b=$this->pdo->prepare('SELECT b.blocked_player_id,b.reason,b.created_at,COALESCE(p.display_name,p.username) blocked_name FROM blacklists b JOIN players p ON p.id=b.blocked_player_id WHERE b.player_id=? ORDER BY b.created_at DESC');$b->execute([$playerId]);$r=$this->pdo->prepare('SELECT id,COALESCE(display_name,username) display_name,username FROM players WHERE id<>? ORDER BY display_name,username LIMIT 200');$r->execute([$playerId]);return ['state'=>($inbox||$sent)?'ready':'empty','inbox'=>$inbox,'sent'=>$sent,'blacklist'=>$b->fetchAll(PDO::FETCH_ASSOC),'commanders'=>$r->fetchAll(PDO::FETCH_ASSOC),'unread_count'=>count(array_filter($inbox,static fn(array $m):bool=>$m['read_at']===null)),'states'=>['loading','ready','empty','success','error']];
    }

    public function send(int $senderId,int $recipientId,string $subject,string $body): int
    {
        if($senderId<1||$recipientId<1||$senderId===$recipientId)throw new InvalidArgumentException('Invalid message recipient.');$subject=trim($subject);$body=trim($body);if($subject===''||strlen($subject)>160)throw new InvalidArgumentException('Subject must contain 1–160 characters.');if($body===''||strlen($body)>10000)throw new InvalidArgumentException('Message body must contain 1–10,000 characters.');$this->pdo->beginTransaction();try{$cooldown=$this->setting('message_send_cooldown_seconds');$maxPerMinute=max(1,$this->setting('message_rate_limit_per_minute',10));$c=$this->pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='message_send' FOR UPDATE");$c->execute([$senderId]);$available=$c->fetchColumn();if($available!==false&&new DateTimeImmutable((string)$available)>new DateTimeImmutable('now'))throw new RuntimeException('Message sending is on cooldown.');$p=$this->pdo->prepare('SELECT id FROM players WHERE id=? FOR UPDATE');$p->execute([$recipientId]);if(!$p->fetch())throw new RuntimeException('Recipient not found.');$c=$this->pdo->prepare('SELECT COUNT(*) FROM messages WHERE sender_id=? AND created_at>=DATE_SUB(NOW(),INTERVAL 1 MINUTE)');$c->execute([$senderId]);if((int)$c->fetchColumn()>=$maxPerMinute)throw new RuntimeException('Message rate limit exceeded.');$b=$this->pdo->prepare('SELECT 1 FROM blacklists WHERE (player_id=? AND blocked_player_id=?) OR (player_id=? AND blocked_player_id=?) LIMIT 1');$b->execute([$senderId,$recipientId,$recipientId,$senderId]);if($b->fetchColumn()!==false)throw new RuntimeException('Messaging is blocked by blacklist policy.');$this->pdo->prepare('INSERT INTO messages(sender_id,recipient_id,subject,body) VALUES(?,?,?,?)')->execute([$senderId,$recipientId,$subject,$body]);$id=(int)$this->pdo->lastInsertId();$this->pdo->prepare("INSERT INTO player_notifications(player_id,notification_type,title,body) VALUES(?,?,?,?)")->execute([$recipientId,'message','New message from commander',$subject]);if($cooldown>0){$next=(new DateTimeImmutable('now'))->modify('+'.$cooldown.' seconds')->format('Y-m-d H:i:s');$this->pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$senderId,'message_send',$next]);}$this->event($senderId,'message_sent',$id,['recipient_id'=>$recipientId,'subject_length'=>strlen($subject),'body_length'=>strlen($body),'cooldown_seconds'=>$cooldown]);$this->pdo->commit();return $id;}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function markRead(int $recipientId,int $messageId): array
    {
        if($recipientId<1||$messageId<1)throw new InvalidArgumentException('Invalid message read request.');$this->pdo->beginTransaction();try{$s=$this->pdo->prepare('SELECT id,subject,read_at FROM messages WHERE id=? AND recipient_id=? FOR UPDATE');$s->execute([$messageId,$recipientId]);$message=$s->fetch(PDO::FETCH_ASSOC);if(!$message)throw new RuntimeException('Message unavailable or recipient ownership failed.');$this->pdo->prepare('UPDATE messages SET read_at=COALESCE(read_at,NOW()) WHERE id=? AND recipient_id=?')->execute([$messageId,$recipientId]);$this->pdo->prepare('UPDATE player_notifications SET is_read=1 WHERE player_id=? AND notification_type=\'message\' AND is_read=0 AND title=\'New message from commander\' AND body=?')->execute([$recipientId,$message['subject']]);$this->event($recipientId,'message_read',$messageId,['previously_read'=>$message['read_at']!==null]);$this->pdo->commit();return ['state'=>'success','message_id'=>$messageId,'previously_read'=>$message['read_at']!==null];}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }

    public function blacklist(int $playerId,int $blockedId,string $reason=''): void
    {
        if($playerId<1||$blockedId<1||$playerId===$blockedId)throw new InvalidArgumentException('Invalid blacklist target.');$reason=trim($reason);if(strlen($reason)>255)throw new InvalidArgumentException('Blacklist reason is too long.');$this->pdo->beginTransaction();try{$p=$this->pdo->prepare('SELECT id FROM players WHERE id=? FOR UPDATE');$p->execute([$blockedId]);if(!$p->fetch())throw new RuntimeException('Blacklist target not found.');$this->pdo->prepare('INSERT INTO blacklists(player_id,blocked_player_id,reason) VALUES(?,?,?) ON DUPLICATE KEY UPDATE reason=VALUES(reason)')->execute([$playerId,$blockedId,$reason]);$this->event($playerId,'player_blacklisted',$blockedId,['reason'=>$reason]);$this->pdo->commit();}catch(Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}
    }
}
