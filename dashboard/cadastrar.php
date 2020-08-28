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



}elseif(isset($_POST['cadastrar-associado']) && ($_POST['cadastrar-associado']=='form1')){
    require_once '../class/DAO/Associados.php';
    require_once '../class/entidades/Associados.class.php';

    $associadosDAO = new AssociadosDAO;
    $associado = new Associados;

    $nome = $_POST['ass_nome'];
    $cpf = $_POST['ass_cpf'];
    $data = $_POST['ass_data_nasc'];
    $profissao = $_POST['ass_prof'];
    $endereco = $_POST['ass_end'];
    $cep = $_POST['ass_cep'];
    $telefone = $_POST['ass_tel'];
    $email = $_POST['ass_email'];
    $pagamento = $_POST['ass_paga'];
    $status = $_POST['ass_status'];
    $senha = $associadosDAO->limpaCPF($_POST['ass_cpf']);

    $associado->setNome($nome);
    $associado->setCpf($cpf);
    $associado->setData_nasc($data);
    $associado->setProfissao($profissao);
    $associado->setEndereco($endereco);
    $associado->setCep($cep);
    $associado->setTelefone($telefone);
    $associado->setEmail($email);
    $associado->setPagamento($pagamento);
    $associado->setStatus($status);
    $associado->setSenha($senha);

    $associadosDAO->cadastrarAssociado($associado);


}else{
    echo 'erro no cadastro!';
}


?>