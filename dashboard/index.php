<!--
Author: Bruno Brandão
-->

<?php

//session_start();
//ob_start();

//if(!isset($_SESSION['admin'])){

//	header ('location: index.php?erro=login');
  
//  }else{
  
	require_once '../class/DAO/Conexao.class.php';
//	require_once '../class/DAO/Usuarios.php';
	require_once '../class/DAO/Apoiadores.php';
   
//	$id = $_SESSION['admin'];
  
//	$usuarioDAO = new UsuarioDAO;
	$apoiadoresDAO = new ApoiadoresDAO;
  
//	$usuario = $usuarioDAO->buscaUm($id);




?>


<!doctype html>
<html lang="pt-BR">
  <head>
	<title>Apoiadores</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Animete CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	
	<script>
		$(document).ready(function($){
			$("#apoio_telefone").mask("(00) 00000-0000");
		});
	</script>
</head>
  <body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand">Cadastro de Apoiadores - Orleando 2020</a>
		</div>
	</nav>	  
	<div class="container">
		<div class="card">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active"><a href="#">Início</a></li>
				</ol>
			</nav>
			<div class="card-body">
				<h5>Bem vindo! Por favor, escolha a opção desejada.</h5>
				
				
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
 // };
?>
