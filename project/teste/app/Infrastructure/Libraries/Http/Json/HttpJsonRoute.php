<?php
namespace App\Infrastructure\Libraries\Http\Json;

class HttpJsonRoute implements HttpJsonRouteInterface {
        private array $routes = [];

        public function get(string $route, callable $callback): void {
            $this->addRoute('GET', $route, $callback);
        }

        public function post(string $route, callable $callback): void {
            $this->addRoute('POST', $route, $callback);
        }

        public function put(string $route, callable $callback): void {
            $this->addRoute('PUT', $route, $callback);
        }

        public function delete(string $route, callable $callback): void {
            $this->addRoute('DELETE', $route, $callback);
        }

        private function addRoute(string $method, string $route, callable $callback): void {
            $route = rtrim($route, '/');;
            $this->routes[$method][$route] = $callback;
        }

        private function formatJsonResponse($content, int $code = 200, $message = '') {
            header('Content-Type: application/json');
            http_response_code($code);

            return json_encode([
                'code' => $code,
                'data' => $content,
                'message' => $message
            ]);
        }

        private function notFoundResponse($content = [], int $code = 404, $message = 'Route not found')
        {
            return $this->formatJsonResponse($content, $code, $message);
        }

        public function handleRequest() {
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestUri = $_SERVER['REQUEST_URI'];
            $param = '';

            $requestPath = rtrim(parse_url($requestUri, PHP_URL_PATH), '/');
            $checkParam = ltrim($requestPath, "/");
            $explodeParam = explode("/",$checkParam);
            $body = json_decode(file_get_contents('php://input'), true);

            if(count($explodeParam) > 1){
                $requestPath = "/{$explodeParam[0]}/{param}";
                $param = $explodeParam[1];
            }

            if (isset($this->routes[$requestMethod][$requestPath])) {
                $callback = $this->routes[$requestMethod][$requestPath](['body' => $body, 'param' => $param]);
                $callback = $this->formatJsonResponse($callback['data'], $callback['status_code'], $callback['message']);
            } else {
                $callback = $this->notFoundResponse();
            }

            echo $callback;
        }
}
?>