<?php
    session_start();
    ob_start();

    if ($_POST) {
        $secret_key = "6LfLUMYZAAAAAJ0tJA6Kg3Aqgjr0MomN274Dx390";
        $recaptcha_response = $_POST['g-recaptcha-response'];

        if (isset($recaptcha_response)) {
                // Valido se a ação do usuário foi correta junto ao google
            $answer =
                json_decode(
                file_get_contents(
                    'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key .
                        '&response=' . $_POST['g-recaptcha-response']
                )
            );

                // Se a ação do usuário foi correta executo o restante do meu formulário
            if ($answer->success) {

                require_once '../class/DAO/Conexao.class.php';
                require_once '../class/DAO/Usuarios.php';
                require_once '../class/entidades/Usuarios.class.php';

                $usuarioDAO = new UsuarioDAO;

                $login = $_POST['login'];
                $senha = $_POST['senha'];

               

                $userId = $usuarioDAO->executaLogin($login,$senha);

                if($userId != 0){
                    //SE LOGIN RETORNOU UM ID, INICIA SESSAO
                    $_SESSION['login'] = $login;
                    $_SESSION['senha'] = $senha;

                    $_SESSION['admin'] = $userId;

                    header("location: ../dashboard/index.php");
                }else{
                    header("location: index.php?erro=login-invalido");
                }
            }else{
                header("location: index.php?erro=captcha");
            }

        }

    }
?>