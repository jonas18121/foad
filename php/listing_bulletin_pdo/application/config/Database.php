<?php

class Database{

    public $sql_host;
    public $sql_login;
    public $sql_pwd;
    public $sql_db;
    public $dsn;
    public $bdd;

    public function __construct()
    {
        $this->sql_host     = "127.0.0.1";
        $this->sql_login    = "root";
        $this->sql_pwd      = "";
        $this->sql_db       = "bulletin";
        $this->dsn          = "mysql:host={$this->sql_host};dbname={$this->sql_db};charset=UTF8";
    } 

    public function connect_bdd()
    {
        return $this->bdd = $this->bdd = new PDO($this->dsn, $this->sql_login, $this->sql_pwd);
    }
}

