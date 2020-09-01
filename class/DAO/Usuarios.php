<?php 
    require_once 'Conexao.class.php';
    require_once '../class/entidades/Usuarios.class.php';

    class UsuarioDAO{
        private $conexao;
       

        function __construct(){
            $this->conexao = new Conexao();
           
        }

        function executaLogin($login,$senha){
            $id = 0;
            $sql = "SELECT * FROM usuarios WHERE usu_login ='$login'";
    
            $consulta = mysqli_query($this->conexao->getCon(), $sql);
    
            $array = mysqli_fetch_assoc($consulta);
            $check = password_verify($senha, $array['usu_senha']);
            if ($check == true){
                $id = $array['usu_id'];
    
                return $id;
            }else{
                return null;
            }
            
    
        }

        function buscaUm($id){
            $sql= "SELECT * FROM usuarios WHERE usu_id ='$id' ";
            $consulta = mysqli_query($this->conexao->getCon(), $sql);
            $user = mysqli_fetch_assoc($consulta);
            return $user;
        }

        function listarUsuarios(){
            $listas = array();

            $sql = "SELECT * FROM usuarios ORDER BY usu_nome ASC";
            $consulta = mysqli_query($this->conexao->getCon(), $sql);
            while ($array = mysqli_fetch_assoc($consulta)){
                $lista = new Usuarios;

                $lista->setId($array['usu_id']);
                $lista->setNome($array['usu_nome']);
                $lista->setLogin($array['usu_login']);

                array_push($listas, $lista);

            }
            return $listas;
            
        }

        function cadastrarUsuario(Usuarios $usuario){
            $nome = $usuario->getNome();
            $login = $usuario->getLogin();
            $senha = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
            $tipo = 'usuario';

            //teste para evitar usuario em duplicidade
            $sql_teste= "SELECT * FROM usuarios WHERE usu_login='$login'";
            $consulta_teste = mysqli_query($this->conexao->getCon(), $sql_teste);
            $teste= mysqli_fetch_assoc($consulta_teste);
            if(!empty($teste)){
                header("location: inserirUsuario.php?erro=usuario-ja-cadastrado");
            }else{
                $sql= "INSERT INTO usuarios (usu_nome, usu_login, usu_senha, usu_tipo)
                 VALUES('$nome','$login','$senha','$tipo')";
                $q = mysqli_query($this->conexao->getCon(), $sql);     
                if($q == TRUE){ 
                    $x = 0;
                    header('Location: gerenciarUsuarios.php?cadastro=sucesso');
                }
                else{ 
                    $x = 1;
                    header('Location: gerenciarUsuarios.php?cadastro=db-falha'); 
                }
            }
        }

        function editarUsuario(Usuarios $usuario){
            $id = $usuario->getId();
            $nome = $usuario->getNome();
            $login = $usuario->getLogin();
           
            $sql= "UPDATE usuarios SET usu_nome='$nome', usu_login='$login' WHERE usu_id='$id'";
            $q = mysqli_query($this->conexao->getCon(), $sql);     
                if($q == TRUE){ 
                    $x = 0;
                    header('Location: gerenciarUsuarios.php?editar=sucesso');
                }
                else{ 
                    $x = 1;
                    header('Location: gerenciarUsuarios.php?editar=db-falha'); 
                }
        }

        public function geraChave(Usuarios $user){
            
            $email = $user->getLogin();
            $sql_teste= "SELECT * FROM usuarios WHERE usu_login='$email'";
            $consulta_teste = mysqli_query($this->conexao->getCon(), $sql_teste);
            $teste= mysqli_fetch_assoc($consulta_teste);
            if(!empty($teste)){
                // o usuário existe, vamos gerar uma chave unica
                $chave = substr(md5($teste['usu_senha'].$teste['usu_id']), 0, 20);
                return $chave;
    
            }else{
                header('Location: esqueci-senha.php?erro=email-nao-encontrado');
            }
        }
    
        public function checkChave($email, $chave){
           
            
            $sql_teste= "SELECT * FROM usuarios WHERE usu_login='$email'";
            $consulta_teste = mysqli_query($this->conexao->getCon(), $sql_teste);
            $teste= mysqli_fetch_assoc($consulta_teste);
            if(!empty($teste)){
                // o usuário existe, 
                $chaveCorreta = substr(md5($teste['usu_senha'].$teste['usu_id']), 0, 20);
               if($chave == $chaveCorreta){
                   return $teste['usu_id'];
               }
    
            }else{
                header('Location: alterar-senha.php?erro=email-nao-encontrado');
            }
        }
    
        public function setNovaSenha(Usuarios $user){
            $id = $user->getId();
            $senha = password_hash($user->getSenha(), PASSWORD_DEFAULT);
            $sql= "UPDATE usuarios SET usu_senha='$senha' WHERE usu_id='$id'";
            $q = mysqli_query($this->conexao->getCon(), $sql);
            if($q == TRUE){ 
                $x = 0;
                header('Location: index.php?mudar-senha=sucesso');
            }
            else{ 
                $x = 1;
                header('Location: alterar-senha.php?erro=email-nao-encontrado');
            }
            return $x;
            }

        function excluirUsuario(Usuarios $usuario){
            $id = $usuario->getId();
            $sql = "DELETE FROM usuarios WHERE usu_id = '$id'";

            $r = mysqli_query($this->conexao->getCon(), $sql);
            if($r == TRUE){
                 $x = 0; 
                 header('Location: gerenciarUsuarios.php?excluir=sucesso');
                }else{ 
                     $x = 1;
                     header('Location: gerenciarUsuarios.php?excluir=db-falha'); 
                    }
            return $x;
        }


    }

?>