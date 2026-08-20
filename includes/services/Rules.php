<?php
declare(strict_types=1);
final class Rules {
    public static function positiveInt(mixed $value,string $field,int $max=PHP_INT_MAX):int{$n=filter_var($value,FILTER_VALIDATE_INT);if($n===false||$n<1||$n>$max)throw new InvalidArgumentException($field.' must be between 1 and '.$max);return $n;}
    public static function text(mixed $value,string $field,int $max=255):string{$text=trim((string)$value);if($text===''||mb_strlen($text)>$max)throw new InvalidArgumentException($field.' is invalid');return $text;}
    public static function cannotFarm(PDO $pdo,int $attackerId,int $defenderId):void{if($attackerId===$defenderId)throw new RuntimeException('Self-targeting is not allowed');$s=$pdo->prepare('SELECT COUNT(*) FROM battles WHERE attacker_id=? AND defender_id=? AND created_at>=DATE_SUB(NOW(),INTERVAL 24 HOUR)');$s->execute([$attackerId,$defenderId]);if((int)$s->fetchColumn()>=5)throw new RuntimeException('Daily target limit reached');}
    public static function isProtected(array $player):bool{$now=new DateTimeImmutable('now');foreach(['vacation_until','protected_until'] as $field)if(!empty($player[$field])&&new DateTimeImmutable($player[$field])>$now)return true;return false;}
}
?>
