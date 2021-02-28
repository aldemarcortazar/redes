<?php


class Login extends SessionController{
    function __construct()
    {
        parent::__construct();
    }

    public function render(){
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/' , $actualLink);
        $this->view->errorMessague = '';
        $this->view->render('login/index'); 
    }
}