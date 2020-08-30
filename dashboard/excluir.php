<?php

if(isset($_POST['excluir_usuario']) && ($_POST['excluir_usuario']=='form1')){
    require_once '../class/DAO/Usuarios.php';
    require_once '../class/entidades/Usuarios.class.php';
    
    $usuarioDAO = new UsuarioDAO;
    $usuario = new Usuarios;

    $id = $_POST['usu_id'];
    $usuario->setId($id);
    $usuarioDAO->excluirUsuario($usuario);
   
}elseif(isset($_POST['excluir_apoiador']) && ($_POST['excluir_apoiador']=='form1')){

	require_once '../class/DAO/Apoiadores.php';
	require_once '../class/entidades/Apoiadores.class.php';

	$apoiadorDAO = new ApoiadoresDAO;
	$apoiador = new Apoiadores;

    $id = $_POST['apoio_id'];
    $apoiador->setId($id);

    $apoiadorDAO->excluirApoiador($apoiador);
}else{
    echo "Erro!";
}


?>