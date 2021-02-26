<?php

class DataBase{
    private $host; 
    private $db;
    private $user;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
    }

    function connect(){
        try{
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);

            if($this->connection ->connect_errno){
                die ("Fallo la conexion en la bd");
            }
            return $this->connection;
        }catch(Throwable $th){
            echo "el error esta en " . $th;
        } 
    }
}
