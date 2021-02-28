<?php
// require_once 'errores'
class App{

    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url']: null;
        echo $url;
        $url = rtrim($url , '/');

        $url = explode('/', $url);
        if(empty($url[0])){
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';
        if(file_exists($archivoController)){
            require_once $archivoController;
            // iniciamos el controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            // si existe un metodo que lo carge
            if(isset($url[1])){

                if(method_exists($controller , $url[1])){
                    if(isset($url[2])){
                        $nparamt = sizeof($url)-2;
                        $parametros = [];
                        for ($i = 0; $i < $nparamt; $i++){
                            array_push($parametros, $url[$i + 2]);
                        } 

                        $controller->{$url[1]}($parametros); 
                    }
                        else{
                            $controller->{$url[1]}();
                        }
                }
                else{
                    $controller = new Errores();
                }
            }
            else{
                $controller->render();
            }
        }else{
            $controller = new Errores();
        }
    }
}
