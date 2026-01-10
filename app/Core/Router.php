<?php
namespace App\Core;

class Router {
    private array $routes = [];

    public function post(string $path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    public function get(string $path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo json_encode(['message' => 'Route tidak ditemukan']);
            return;
        }

        [$class, $methodName] = $this->routes[$method][$uri];
        call_user_func([new $class, $methodName]);
    }
}
