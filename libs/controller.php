<?php

class Controller{
    function __construct(){
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'models/'.$model.'model.php';

        if (file_exists($url)){
            require_once $url;
            $model_name = $model.'Model';
            $this->$model = new $model_name();
        }
    }

    function exitsPost($params){
        foreach($params as $param){
            if(!isset($_POST[$param])){
                return false;
            }
        }
        return true;
    }

    function exitsGet($params){
        foreach($params as $param){
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    function redirect($url, $message = []){
        $data = [];
        $param = "";

        foreach($message as $key=>$value){
            array_push($data, $key . "=" . $value);
        }
        $param = join("&", $data);

        if($param != ""){
            $param = "?" . $param;
        }

        header('location: ' . constant('URL') . $url . $param);
    }
}