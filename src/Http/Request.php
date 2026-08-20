<?php
declare(strict_types=1);
namespace SGW\Http;
final class Request {
    public static function json(): array { $data=json_decode(file_get_contents('php://input') ?: '',true); return is_array($data)?$data:[]; }
    public static function bearerToken(): ?string { $h=$_SERVER['HTTP_AUTHORIZATION']??''; return preg_match('/Bearer\s+(.+)/i',$h,$m)?trim($m[1]):null; }
    public static function input(string $key,mixed $default=null): mixed { return $_POST[$key] ?? $_GET[$key] ?? $default; }
}
