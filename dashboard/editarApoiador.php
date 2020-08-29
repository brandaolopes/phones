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
if (isset($_GET['apoio_id'])){
	$apoiador = $apoiadoresDAO->buscaUm($_GET['apoio_id']);
}



?>


<!doctype html>
<html lang="pt-BR">
  <head>
	<title>Gerenciar Apoiadores</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Animete CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
	
	<script>
		jQuery(function($){
		$("#apoio_telefone").mask("(00) 0 0000-0009");
		});
	</script>
</head>
  <body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand">Editar Apoiador</a>
		</div>
	</nav>	  
	<div class="container">
		<div class="card">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Início</a></li>
					<li class="breadcrumb-item"><a href="gerenciarApoiadores.php">Gerenciar Apoiadores</a></li>
					<li class="breadcrumb-item active">Editar Apoiador</li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $apoiador['apoio_nome'] ?></li>
				</ol>
			</nav>
			<div class="card-body">
				<?php
                      if(isset($_GET['erro']) && $_GET['erro']=='apoiador-ja-cadastrado'){ ?>
                        <div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
                        	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Apoiador já cadastrado anteriormente! Evite cadastros em duplicidade.</strong></div>
                <?php }; ?>
				<form action="editar.php" name="form1" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="apoio_nome">Nome</label>
							<input type="text" class="form-control" id="apoio_nome" name="apoio_nome" value="<?php echo $apoiador['apoio_nome'] ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="apoio_telefone">Telefone</label>
							<input type="tel" maxlength="18" data-mask="(00) 0 0000-0000" placeholder="<?php echo $apoiador['apoio_telefone'] ?>"  pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" class="form-control" id="apoio_telefone" name="apoio_telefone" value="">
						</div>
					</div>
					<input type="hidden" name="apoio_id" value="<?php $_GET['apoio_id']?>">
					<input type="hidden" name="editar_apoiador" value="form1">
					<button type="submit" class="btn btn-primary">Salvar!</button>
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
 // };
?>
