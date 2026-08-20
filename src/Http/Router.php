<?php
declare(strict_types=1);
namespace SGW\Http;
final class Router {
    private array $routes=['GET'=>[],'POST'=>[]];
    public function get(string $path,callable $handler):void{$this->routes['GET'][$path]=$handler;}
    public function post(string $path,callable $handler):void{$this->routes['POST'][$path]=$handler;}
    public function dispatch(string $method,string $path):mixed{$handler=$this->routes[strtoupper($method)][$path]??null;if(!$handler)Response::json(['error'=>'Route not found'],404);return $handler();}
}
