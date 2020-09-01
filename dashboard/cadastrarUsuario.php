<!--
Author: Bruno Brandão
-->

<?php

session_start();
ob_start();

if(!isset($_SESSION['admin'])){

	header ('location: ../sign-in/index.php?erro=login');
  
  }else{
  
	require_once '../class/DAO/Conexao.class.php';
	require_once '../class/DAO/Usuarios.php';
	require_once '../class/DAO/Apoiadores.php';
   
	$id = $_SESSION['admin'];
  
	$usuarioDAO = new UsuarioDAO;
	$apoiadoresDAO = new ApoiadoresDAO;
  
	$usuario = $usuarioDAO->buscaUm($id);



?>


<!doctype html>
<html lang="pt-BR">
  <head>
	<title>Cadastrar Usuário</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Animete CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	
	<script>
		jQuery(function($){
		$("#apoio_telefone").mask("(00) 0000-00009");
		});
	</script>
</head>
  <body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand">Cadastrar Usuário</a>
		</div>
	</nav>	  
	<div class="container">
		<div class="card">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Início</a></li>
					<li class="breadcrumb-item"><a href="gerenciarUsuarios.php">Gerenciar Usuários</a></li>
					<li class="breadcrumb-item active" aria-current="page">Cadastrar Usuário</li>
				</ol>
			</nav>
			<div class="card-body">
				<?php
                      if(isset($_GET['erro']) && $_GET['erro']=='usuario-ja-cadastrado'){ ?>
                        <div class='animated shake alert alert-danger alert-dismissible col-md-6' style='border:1px solid red; text-align: center; margin-top: 10px;'>
                        	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Usuário já cadastrado anteriormente!</strong> 
							<p>Evite cadastros em duplicidade.</p>
						</div>
                <?php }; ?>
				<form action="cadastrar.php" name="form1" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="usu_nome">Nome:</label>
							<input type="text" class="form-control" id="usu_nome" name="usu_nome" required>
						</div>
						<div class="form-group col-md-6">
							<label for="usu_email">Email:</label>
							<input type="email"  placeholder="seunome@provedor.com.br"  class="form-control" id="usu_email" name="usu_email" required>
						</div>
						<div class="form-group col-md-4">
							<label for="usu_senha">Senha:</label>
							<input type="password" class="form-control" id="usu_senha" name="usu_senha" required>
						</div>
					</div>
					<input type="hidden" name="cadastrar-usuario" value="form1">
					<button type="submit" class="btn btn-primary">Cadastrar!</button>
				</form>
			</div>
		</div>

	</div>



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="./js/jquery.mask.min.js"> </script>
</body>
</html>


<?php
  };
?>
