<?php 

    class Usuarios {
        private $id;
        private $nome;
        private $login;
        private $senha;
        private $tipo;

            function __construct(){
                
            }

            function getId() {
                return $this->id;
            }

            function getNome() {
                return $this->nome;
            }

            function getLogin() {
                return $this->login;
            }

            function getSenha() {
                return $this->senha;
            }

            function getTipo(){
                return $this->tipo;
            }

            function setId($id) {
                $this->id = $id;
            }

            function setNome($nome) {
                $this->nome = $nome;
            }

            function setLogin($login){
                $this->login = $login;
            }

            function setSenha($senha) {
                $this->senha = $senha;
            }

            function setTipo($tipo){
                $this->tipo = $tipo;
            }
    }

?>