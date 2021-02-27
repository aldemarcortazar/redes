<?php


class SuccessMessagues{
    const PRUEBA = 'f52228665c4f14c8695b194f670b0ef1' ;
    private $successList = [];
    public function __construct()
    {
        $this->successList = [
            SuccessMessagues::PRUEBA => "este es un mensaje de prueba",
        ];
    }

    function get($hash){
        return $this->successList[$hash];
    }
    function existKey($key){
        if(array_key_exists($key , $this->successList)){
            return true;
        }else{
            return false;
        }
    }
}