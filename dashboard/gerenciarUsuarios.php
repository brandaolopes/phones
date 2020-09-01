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

   
	$id = $_SESSION['admin'];
  
	$usuarioDAO = new UsuarioDAO;

  
	$usuario_1 = $usuarioDAO->buscaUm($id);



        $usuarios = $usuarioDAO->listarUsuarios();

	

?>


<!doctype html>
<html lang="pt-BR">
  <head>
	<title>Gerenciar Usuários</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Animete CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  
</head>
  <body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand">Gerenciar Usuários</a>
			
		</div>
	</nav>	  
	<div class="container">
		<div class="card">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="pos-index.php">Início</a></li>
					<li class="breadcrumb-item active" aria-current="page">Gerenciar Usuários</li>
				</ol>
			</nav>
			<div class="card-body">
					<div class="col-6">
						<a href="cadastrarUsuario.php" class="btn btn-primary md-04">Novo Usuário</a>
					</div>
					<?php
						if(isset($_GET['cadastro']) && $_GET['cadastro']=='sucesso'){ ?>
							<div class='animated shake alert alert-success alert-dismissible' style='border:1px solid green; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Usuário cadastrado com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if(isset($_GET['editar']) && $_GET['editar']=='sucesso'){ ?>
							<div class='animated shake alert alert-success alert-dismissible' style='border:1px solid green; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Usuário modificado com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if(isset($_GET['excluir']) && $_GET['excluir']=='sucesso'){ ?>
							<div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Usuário excluído com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if((isset($_GET['cadastro']) && $_GET['cadastro']=='db-falha') || (isset($_GET['editar']) && $_GET['editar']=='db-falha') || (isset($_GET['excluir']) && $_GET['excluir']=='db-falha')){ ?>
							<div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Erro no banco de dados!</strong> Por favor, tente novamente mais tarde.</div>
					<?php }; ?>
					<p>&nbsp;</p>
					<table class="table table-striped">
						<thead class="thead-light">
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">E-mail</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($usuarios as $usuario) {
								$nome = $usuario->getNome();
								$email = $usuario->getLogin();
								$apoio_id = $usuario->getId();
						?>
							<tr>
								<td><?php echo $nome; ?></td>
								<td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></td>
								<td><button class="btn btn-light"><a href="#"><img src="img/edit.png" width="25"></a></button>
									<button class="btn btn-light"><a href="#"><img src="img/delete.png" width="25"></a></button>
								</td>
							</tr>
							<?php } ; ?>
						</tbody>
					</table>

					
				
			</div>
		</div>

	</div>



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


<?php
  };
?>
