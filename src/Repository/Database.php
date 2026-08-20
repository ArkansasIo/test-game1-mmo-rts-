<?php
declare(strict_types=1);
namespace SGW\Repository;
use PDO;
final class Database {
    private static ?PDO $pdo=null;
    public static function connection():PDO { if(self::$pdo)return self::$pdo; $c=require __DIR__.'/../../config/database.php'; $dsn="mysql:host={$c['host']};port={$c['port']};dbname={$c['database']};charset={$c['charset']}"; self::$pdo=new PDO($dsn,$c['username'],$c['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]); return self::$pdo; }
}
