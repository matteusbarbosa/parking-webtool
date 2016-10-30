<?php

class Conexao {

    protected $lig;
    public $mysqli;

    final public function getConnection() {
        
        $host= "us-cdbr-azure-southcentral-f.cloudapp.net";
        $banco="tecweb_t1";
        $user= "be1ff072656392";
        $pass ="2b1314f9";

        $this->mysqli = new mysqli($host, $user, $pass, $banco);

        $this->mysqli->set_charset("utf8");

        if (mysqli_connect_errno()) {

            echo "Erro: Não se conectou.";

            exit;
        } else {
            return $this->mysqli;
        }
    }

    public function __construct($con = null) {
        if ($con == null) {
            //método utilizado para abrir a conexao com o banco
            $this->con = $this->getConnection();
        } else {
            $this->con = $con;
        }
    }


    public function setCon($con) {
        $this->con = $con;
    }

    public function getCon() {
        return $this->con;
    }

    public function __destruct() {
        $this->mysqli->close();
    }
}
