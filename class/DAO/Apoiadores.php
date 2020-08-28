<?php 
    require_once 'Conexao.class.php';
    require_once '../class/entidades/Apoiadores.class.php';

    class ApoiadoresDAO{
        private $conexao;
       

        function __construct(){
            $this->conexao = new Conexao();
           
        }

        public function limpaCPF($cpf){
            $cpf = trim($cpf);
            $cpf = str_replace(".", "", $cpf);
            $cpf = str_replace(",", "", $cpf);
            $cpf = str_replace("-", "", $cpf);
            $cpf = str_replace("/", "", $cpf);
            return $cpf;
        }

        function contaApoiadores(){
            $sql = "SELECT * FROM apoiadores";
                $consulta = mysqli_query($this->conexao->getCon(), $sql);
                $num_apoiadores = mysqli_num_rows($consulta);
                return $num_apoiadores;
        }

        function buscaUm($id){
            $sql= "SELECT * FROM apoiadores WHERE apoio_id ='$id' ";
            $consulta = mysqli_query($this->conexao->getCon(), $sql);
            $user = mysqli_fetch_assoc($consulta);
            return $user;
        }

        function listarApoiadores($inicio){
            $listas = array();

            $sql = "SELECT * FROM apoiadores ORDER BY apoio_nome ASC LIMIT $inicio, 10";
            $consulta = mysqli_query($this->conexao->getCon(), $sql);
            while ($array = mysqli_fetch_assoc($consulta)){
                $lista = new Apoiadores;

                $lista->setId($array['apoio_id']);
                $lista->setNome($array['apoio_nome']);
                $lista->setTelefone($array['apoio_telefone']);

                array_push($listas, $lista);

            }
            return $listas;
            
        }

        function cadastrarApoiador(Apoiadores $apoiador){
            $nome = $apoiador->getNome();
            $telefone = $apoiador->getTelefone();


            //teste para evitar usuario em duplicidade
            $sql_teste= "SELECT * FROM apoiadores WHERE apoio_telefone='$telefone'";
            $consulta_teste = mysqli_query($this->conexao->getCon(), $sql_teste);
            $teste= mysqli_fetch_assoc($consulta_teste);
            if(!empty($teste)){
                header("location: inserirUsuario.php?erro=usuario-ja-cadastrado");
            }else{
                $sql= "INSERT INTO apoiadores (apoio_nome, apoio_telefone)
                 VALUES('$nome','$telefone')";
                $q = mysqli_query($this->conexao->getCon(), $sql);     
                if($q == TRUE){ 
                    $x = 0;
                    header('Location: gerenciarApoiadores.php?cadastro=sucesso');
                }
                else{ 
                    $x = 1;
                    header('Location: gerenciarApoiadores.php?cadastro=db-falha'); 
                }
            }
        }

        function editarApoiador(Apoiadores $apoiador){
            $id = $apoiador->getId();
            $nome = $apoiador->getNome();
            $telefone = $apoiador->getTelefone();
           
            $sql= "UPDATE apoiadores SET apoio_nome='$nome', apoio_telefone='$telefone' WHERE apoio_id='$id'";
            $q = mysqli_query($this->conexao->getCon(), $sql);     
                if($q == TRUE){ 
                    $x = 0;
                    header('Location: gerenciarApoiadores.php?editar=sucesso');
                }
                else{ 
                    $x = 1;
                    header('Location: gerenciarApoiadores.php?editar=db-falha'); 
                }
        }


        function excluirApoiador(Apoiadores $apoiador){
            $id = $apoiador->getId();
            $sql = "DELETE FROM apoiadores WHERE apoio_id = '$id'";

            $r = mysqli_query($this->conexao->getCon(), $sql);
            if($r == TRUE){
                 $x = 0; 
                 header('Location: gerenciarApoiadores.php?excluir=sucesso');
                }else{ 
                     $x = 1;
                     header('Location: gerenciarApoiadores.php?excluir=db-falha'); 
                    }
            return $x;
        }


    }

?>