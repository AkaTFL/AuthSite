<?php
    class Router {
        private $routes = [];
        private $base = '';

        // ...existing code...
        public function __construct() {
            // détecte le dossier de base (ex: /AuthSite) à partir de SCRIPT_NAME
            $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            if ($scriptDir === '/' || $scriptDir === '.') {
                $scriptDir = '';
            }
            $this->base = $scriptDir;
        }

        public function get($path, $handler) {
            $this->routes['GET'][$this->normalize($path)] = $handler;
        }
        
        public function post($path, $handler) {
            $this->routes['POST'][$this->normalize($path)] = $handler;
        }

        private function normalize($path) {
            if ($path === '') $path = '/';
            if ($path[0] !== '/') $path = '/' . $path;
            if ($path !== '/') $path = rtrim($path, '/');
            return $path;
        }
        
        public function resolve() {
            $method = $_SERVER['REQUEST_METHOD'];
            $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

            // ...existing code...
            // retire le préfixe de base (ex: /AuthSite) si présent
            if ($this->base !== '' && strpos($requestPath, $this->base) === 0) {
                $requestPath = substr($requestPath, strlen($this->base));
                if ($requestPath === '') $requestPath = '/';
            }

            $path = $this->normalize($requestPath);

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
?>