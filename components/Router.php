<?
    class Router {
        private $routes;

        public function __construct(){
            $routesPath = ROOT.'/config/routes.php';
            $this->routes = include($routesPath);
        }
        public function run(){
            echo '<pre>'; print_r($this->routes); echo '</pre>';
        }

    }
?>