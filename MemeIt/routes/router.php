<?php 
    class Router {
        private $routes;

        public function __construct() {
            $this->routes = array();
        }

        public function route($method, $path, $callback) {
            $this->routes[] = array('method' => $method,
                                    'path' => $path,
                                    'callback' => $callback);
        }

        public function run() {
            // $method = $_SERVER['REQUEST_METHOD'];
            $path = empty($_SERVER['PATH_INFO']) ? '' : explode('/', trim($_SERVER['PATH_INFO'],'/'));

            foreach ($this->routes as $route) {
                if($route['method'] == HTTP_METHOD && preg_match("#$route[path]#", URL, $matches)) {
                    $route['callback']($matches);
                    return;
                }
            }
        }
    }
?>