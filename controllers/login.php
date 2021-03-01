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

    public function authentication(){
        if($this->exitsPost(['username', 'password'])){
            $userName=$this->getPost('username');
            $userPass=$this->getPost('password');

            if($userName == "" || empty($userName) || $userPass == "" || empty($userPass)){
                $this->redirect("", ["Error" => ErrorMessagues::ERRORLOGIN]);
                return;
            }
            #Si el login es exitoso, regresa solo el id del usuario
            $user = $this->model->login($userName, $userPass);
            if($user != null){
                $this->initialize($user);
            }
            else{
                #Error al registrar, intentar de nuevo
                $this->redirect("",["Error"=> ErrorMessagues::ERRORAUTHENTICATION]);
                return;
            }
        }
        else{
            $this->redirect("",["Error"=> ErrorMessagues::ERRORPOST]);
        }
    }
}