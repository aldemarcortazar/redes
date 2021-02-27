<?php

class Session{
    private $session_name = 'user';

    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function set_current_user($user){
        $_SESSION[$this->session_name] = $user;
    }

    public function get_current_user(){
        return $_SESSION[$this->session_name];
    }

    public function close_session(){
        session_unset();
        session_destroy();
    }

    public function exists(){
        return isset($_SESSION[$this->session_name]);
    }
}