<?php

class View{

    public function __construct()
    {
        
    }

    function render($nombre , $data = []){
        $this->d = $data;

        $this->handleMessague();
        require_once 'views/' . $nombre . '.php';
    }

    private function handleMessague(){
        if(isset($_GET['succes']) && isset($_GET['error'])){
            // error
        }elseif( isset($_GET['success']) ){
            $this->handleSuccess();
        }elseif(isset($_GET['error'])){
            $this->handleError();
        }
    }

    private function handleError(){
        $hash = $_GET['error'];
        $error = new ErrorMessagues();

        if($error->existKey($hash)){
            $this->d['error'] = $error->get($hash);   
        }
    }

    private function handleSuccess(){
        $hash = $_GET['success'];
        $success = new SuccessMessagues();

        if($success->existKey($hash)){
            $this->d['success'] = $success->get($hash);
        }
    }

    public function showMessagues(){
        $this->showsuccess();
        $this->showErrors();
    }

    private function showsuccess(){
        if(array_key_exists('success' , $this->d)){
            echo '<div class="success">' . $this->d['success'] . '</div>';
        }
    }

    private function showErrors(){
        if(array_key_exists('error' , $this->d)){
            echo '<div class="error">' . $this->d['error'] . '</div>';
        }
    }


}