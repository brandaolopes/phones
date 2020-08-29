<?php

if(isset($_POST['editar_usuario']) && ($_POST['editar_usuario']=='form1')){
    require_once '../class/DAO/Usuarios.php';
    require_once '../class/entidades/Usuarios.class.php';

    $usuarioDAO = new UsuarioDAO;
    $usuario = new Usuarios;

    $id = $_POST['usu_id'];
    $nome = $_POST['usu_nome'];
    $login = $_POST['usu_login'];
    

    $usuario->setNome($nome);
    $usuario->setLogin($login);
    $usuario->setId($id);

    $usuarioDAO->editarUsuario($usuario);

}elseif(isset($_POST['editar_apoiador']) && ($_POST['editar_apoiador']=='form1')){

	require_once '../class/DAO/Apoiadores.php';
	require_once '../class/entidades/Apoiadores.class.php';

	$apoiadorDAO = new ApoiadoresDAO;
	$apoiador = new Apoiadores;

	$id = $_POST['apoio_id'];
	$nome = $_POST['apoio_nome'];
	$telefone = trim($apoiadorDAO->limpaCPF($_POST['apoio_telefone']));

	$apoiador->setId($id);
	$apoiador->setNome($nome);
	$apoiador->setTelefone($telefone);

	$apoiadorDAO->editarApoiador($apoiador);

}else {
    echo "erro!";
}



?>