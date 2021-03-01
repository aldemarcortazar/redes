<?php

class ErrorMessagues{

    const ERRORPOST = 'c5621207ec1e08de1776734474c0328';
    const ERRORAUTHENTICATION = 'c74112207ec1e08de1778179774c0328';
    const ERRORLOGIN = 'c74193207ec1e38de1783179774c0318';
    const PRUEBA = 'c74163200ec1e78de1223179774c0318';
    private $errorList = [];
    function __construct()
    {
        $this->errorList = [
            ErrorMessagues::PRUEBA => "esto es una prueba",
            ErrorMessagues::ERRORLOGIN => "Error al iniciar sesion, Comprobar datos ingresados",
            ErrorMessagues::ERRORAUTHENTICATION => "ERROR!!, Usuario o Contraseña incorrectos",
            ErrorMessagues::ERRORPOST => "ERROR!!, Al auntenticarse",
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