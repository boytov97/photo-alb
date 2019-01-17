<?php
class Router{
 
    private $route;
    private $controllerName;    
    private $actionName;

    //Получаем маршрут
    private function getURI(){
        return explode("/",trim($_SERVER['REQUEST_URI'],"/"));
    }
    
    //Подключаем роуты (маршрутизаторы)
    private function getRoutes(){
        return $this->route = include(ROOT.'/config/routes.php');
    }
    
    //Метод для проверка
    private function isExistGetController(){
        
        //Получем URI
        $uri = $this->getURI();
        $routes = $this->getRoutes();
        
        //имя запрашиваемый контроллер
        $controllerRequest = array_shift($uri); 
        
        //Проерка запрашиваемого Controller из массива routes.php
        foreach ($routes as $key => $value){
            if (strtolower($key) == strtolower($controllerRequest)) {
                $this->controllerName = $controllerRequest;
                return ucfirst($controllerRequest).'Controller';
            }
        }
    }

    /*Проверка налиции Action 
     * Возвращает если пустой = empty     
     * Возвращает если число = numeric
     */
    private function isExistGetAction(){

        $route = $this->route;
        
        //Получаем запрашиваемый Action (все)
        $actions = $route[$this->controllerName];
        
        $uri = $this->getURI();
        //Искать Action
        
        //Если пустой
        
        if (!isset($uri[1])) {
            return 'index';
        }else if(is_numeric($uri[1])){
            return $uri[1];
        }else{
            foreach ($actions as $value){
                if ($value == $uri[1]) {
                    return $value;
                }
            }
            return;
        }
    }
    
    public function run(){
        
        $controllerName = $this->isExistGetController();
        $actionName = $this->isExistGetAction();
        //print_r($this->getURI());
        if (count(array_filter($this->getURI()))<1) {
            echo '<script>location.href = "http://photoalb:'.PORT.'/album/1";</script>';
        }
        
        if ($controllerName) {//Ввызов метод проверка Controller
            if ($this->isExistGetAction()) {//Ввызов метод проверка Action
                //echo $this->isExistGetController();
                
                //echo $controllerName;
                require_once(ROOT.'/controllers/'.$controllerName.'.php');
                
                $controller = new $controllerName;//Создаем объект

                //Запуск action
                if (is_numeric($this->isExistGetAction())) {
                    $res = 'action'.ucfirst($actionName);
                    //Проверка наличие параметров
                    $uri = $this->getURI();
                    
                    $controller->actionIndex($uri[1]);
                    
                }else{
                    
                    $res = 'action'.ucfirst($actionName);
                    //Проверка наличие параметров
                    $uri = $this->getURI();
                    if ($uri[2]) {
                        $controller->$res($uri[2]);
                    }else{
                        $controller->$res();
                    }
                }
                
                
            }else{
                echo "Not Found 404";
            }
        }else{
            echo "Not Found 404";
        }
    }
    
}
