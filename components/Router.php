<?
    class Router {
        private $routes;

        public function __construct(){
            $routesPath = ROOT.'/config/routes.php';
            $this->routes = include($routesPath);
        }

        private function getUrl(){
            if (!empty($_SERVER)){
               return trim($_SERVER['REQUEST_URI'], '/') ;
            }
        }
        
        public function run(){
            // Получить строку запроса
            $uri = $this->getUrl();
            // Проверить наличие такого запроса в Routs.php
            foreach ($this->routes as $urlPattern => $path) {
                // Если "ок" узнать какой контроллер и экшен обрабатывают запрос
                if (preg_match("~$urlPattern~", $uri)){
                    // Определяем какой контроллер и экшен обрабатывают запрос
                    $segments = explode('/', $path);
                    //echo '<pre>'; print_r($segments); echo '</pre>';
                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName = 'action'.ucfirst(array_shift($segments));

                    // Родключить файл класса контроллера
                    $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                    if (file_exists($controllerFile)){
                        include_once ($controllerFile);
                    }

                    // Создать объект класса и вызвать метод (action)
                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$actionName();
                    if ($result != null){
                        break;
                    }
                }
            }
        }
    }
?>