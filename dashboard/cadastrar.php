<?php

if(isset($_POST['cadastrar_usuario']) && ($_POST['cadastrar_usuario']=='form1')){
    require_once '../class/DAO/Usuarios.php';
    require_once '../class/entidades/Usuarios.class.php';

    $usuarioDAO = new UsuarioDAO();
    $usuario = new Usuarios;

    $nome = $_POST['usu_nome'];
    $login = $_POST['usu_login'];
    $senha = $_POST['usu_senha'];

    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setSenha($senha);

    $usuarioDAO->cadastrarUsuario($usuario);

}elseif(isset($_POST['cadastrar-apoiador']) && ($_POST['cadastrar-apoiador']=='form1')){
	require_once '../class/DAO/Apoiadores.php';
	require_once '../class/entidades/Apoiadores.class.php';

	$apoiadorDAO = new ApoiadoresDAO;
	$apoiador = new Apoiadores;

	$nome = $_POST['apoio_nome'];
	$telefone = trim($apoiadorDAO->limpaCPF($_POST['apoio_telefone']));

	$apoiador->setNome($nome);
	$apoiador->setTelefone($telefone);

	$apoiadorDAO->cadastrarApoiador($apoiador);

}else{
    echo 'erro no cadastro!';
}


?>