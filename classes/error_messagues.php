<?php

class ErrorMessagues{

    const PRUEBA = 'c74163200ec1e78de1223179774c0318';
    private $errorList = [];
    function __construct()
    {
        $this->errorList = [
            ErrorMessagues::PRUEBA => "esto es una prueba",
        ];
    }


    public function get($hash){
        return $this->errorList[$hash];
    }

    public function existKey($key){
        if(array_key_exists($key , $this->errorList)){
            return true;
        }else{
            return false;
        }
    }
}