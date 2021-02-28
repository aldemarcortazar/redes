<?php

class MessagesManager {

    private $messagesList = [];

    public function __construct()
    {
        
    }

    public function get($hash){
        return $this->messagesList[$hash];
    }

    public function existKey($key){
        if(array_key_exists($key, $this->messagesList)){
            return true ;
        }else{
            return false;
        }
    }

}