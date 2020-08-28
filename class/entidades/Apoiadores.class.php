<?php 

    class Apoiadores {
        private $id;
        private $nome;
        private $telefone;


            function __construct(){
                
            }

            function getId() {
                return $this->id;
            }

            function getNome() {
                return $this->nome;
            }

            function getTelefone() {
                return $this->telefone;
            }


            function setId($id) {
                $this->id = $id;
            }

            function setNome($nome) {
                $this->nome = $nome;
            }

            function setTelefone($telefone){
                $this->telefone = $telefone;
            }

 
    }

?>