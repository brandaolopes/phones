<?php

class Conexao {

    private $usuario = "brandaolopes";
    private $senha = "svR3JuG27HWmr9zq";
    private $caminho = "localhost";
    private $banco = "cadastro";

    private $con;
    
    public function __construct() {
        $this->con = mysqli_connect($this->caminho, $this->usuario, $this->senha)or 
                die("Conexão com o banco de dados falhou!");
        mysqli_select_db($this->con, $this->banco)or 
                die("Banco de dados não encontrado, falha!");
    }
    
    public function getCon(){
        return $this->con;
    }            
}

?>