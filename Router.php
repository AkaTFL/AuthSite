<?php
class Router {
    private $routes = [];
    
    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }
    
    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }
    
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $query = $_SERVER['QUERY_STRING'];
        
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo "404 - Page non trouvée";
            return;
        }
        
        $handler = $this->routes[$method][$path];
        [$controller, $methodName] = explode('@', $handler);
        
        $controllerInstance = new $controller();
        $controllerInstance->$methodName();
    }
}
