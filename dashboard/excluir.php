<?php

if(isset($_POST['excluir_usuario']) && ($_POST['excluir_usuario']=='form1')){
    require_once '../class/DAO/Usuarios.php';
    require_once '../class/entidades/Usuarios.class.php';
    
    $usuarioDAO = new UsuarioDAO;
    $usuario = new Usuarios;

    $id = $_POST['usu_id'];
    $usuario->setId($id);
    $usuarioDAO->excluirUsuario($usuario);
   
}elseif(isset($_POST['excluir-associado']) && ($_POST['excluir-associado']=='form1')){
    require_once '../class/DAO/Associados.php';
    require_once '../class/entidades/Associados.class.php';

    $associadoDAO = new AssociadosDAO;
    $associado = new Associados;

    $id = $_POST['ass_id'];
    $associado->setId($id);
    $associadoDAO->excluirAssociado($associado);

}elseif(isset($_POST['excluir-noticia']) && ($_POST['excluir-noticia']=='form1')){
    require_once '../class/DAO/Noticias.php';
    require_once '../class/entidades/Noticias.class.php';

    $noticiasDAO = new NoticiasDAO;
    $noticia = new Noticia;

    $id = $_POST['not_id'];
    $noticia->setId($id);
    $noticiasDAO->excluirNoticia($noticia);

}elseif(isset($_POST['excluir-helper']) && ($_POST['excluir-helper']=='form1')){
    require_once '../class/DAO/Helpers.php';
    require_once '../class/entidades/Helpers.class.php';

    $helperDAO = new HelpersDAO;
    $helper = new Helpers;

    $id = $_POST['help_id'];
    $helper->setId($id);
    $helperDAO->excluirHelper($helper);

}elseif(isset($_POST['excluir-evento']) && ($_POST['excluir-evento']=='form1')){
    require_once '../class/DAO/Eventos.php';
    require_once '../class/entidades/Eventos.class.php';

    $eventoDAO = new EventosDAO;
    $evento = new Eventos;

    $id = $_POST['eve_id'];
    $evento->setId($id);
    $eventoDAO->excluirEvento($evento);
    
}elseif(isset($_POST['excluir-recado']) && ($_POST['excluir-recado']=='form1')){
    require_once '../class/DAO/Guia.php';
    require_once '../class/entidades/Guia.class.php';

    $recadoDAO = new GuiaDAO;
    $recado = new Guia;

    $id = $_POST['guia_id'];
    $recado->setId($id);
    $recadoDAO->excluirRecado($recado);
    
}elseif(isset($_POST['excluir-palestra']) && ($_POST['excluir-palestra']=='form1')){
    require_once '../class/DAO/Palestras.php';
    require_once '../class/entidades/Palestras.class.php';

    $palestraDAO = new PalestrasDAO;
    $palestra = new Palestras;

    $id = $_POST['pal_id'];
    $palestra->setId($id);
    $palestraDAO->excluirPalestra($palestra);

}else{
    echo "Erro!";
}


?>