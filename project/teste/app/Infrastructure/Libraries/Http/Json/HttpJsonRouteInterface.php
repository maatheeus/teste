<?php

namespace App\Infrastructure\Libraries\Http\Json;

interface HttpJsonRouteInterface {
    public function get(string $route, callable $callback): void;
    public function post(string $route, callable $callback): void;
    public function put(string $route, callable $callback): void;
    public function delete(string $route, callable $callback): void;
    public function handleRequest();
}

?>