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

	//Paginação
	$num_apoiadores = $apoiadoresDAO->contaApoiadores();
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$num_paginas = ceil($num_apoiadores/10);
	$inicio = (10*$pagina)-10;


	if (isset($_POST['pesquisa'])){
        $apoiadores = $apoiadoresDAO->buscaVarios($_POST['pesquisa']);
    }else{
        $apoiadores = $apoiadoresDAO->listarApoiadores($inicio);
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
  
</head>
  <body>

	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand">Gerenciar Apoiadores</a>
			<form class="form-inline" method="POST">
				<input class="form-control mr-sm-2" type="search" name="pesquisa" placeholder="Procurar..." aria-label="Procurar">
				<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar Apoiador</button>
			</form>
		</div>
	</nav>	  
	<div class="container">
		<div class="card">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="pos-index.php">Início</a></li>
					<li class="breadcrumb-item active" aria-current="page">Gerenciar Apoiadores</li>
				</ol>
			</nav>
			<div class="card-body">
					<div class="col-6">
						<a href="cadastrarApoiador.php" class="btn btn-primary md-04">Novo apoiador</a>
					</div>
					<?php
						if(isset($_GET['cadastro']) && $_GET['cadastro']=='sucesso'){ ?>
							<div class='animated shake alert alert-success alert-dismissible' style='border:1px solid green; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Apoiador cadastrado com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if(isset($_GET['editar']) && $_GET['editar']=='sucesso'){ ?>
							<div class='animated shake alert alert-success alert-dismissible' style='border:1px solid green; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Apoiador modificado com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if(isset($_GET['excluir']) && $_GET['excluir']=='sucesso'){ ?>
							<div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Apoiador excluído com sucesso!</strong></div>
					<?php }; ?>
					<?php
						if((isset($_GET['cadastro']) && $_GET['cadastro']=='db-falha') || (isset($_GET['editar']) && $_GET['editar']=='db-falha') || (isset($_GET['excluir']) && $_GET['excluir']=='db-falha')){ ?>
							<div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<strong>Erro no banco de dados!</strong> Por favor, tente novamente mais tarde.</div>
					<?php }; ?>
					<?php 
						if (isset($_POST['pesquisa'])){ ?>
							<p>&nbsp;</p>
							<div class="col-6 alert alert-info">
								<p>Listando apoiadores com o termo "<?php echo $_POST['pesquisa']; ?>"</p>
							</div>
						
					<?php }; ?>
					<p>&nbsp;</p>
					<table class="table table-striped">
						<thead class="thead-light">
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Telefone</th>
								<th scope="col">Opções</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($apoiadores as $apoiador) {
								$apoio_nome = $apoiador->getNome();
								$apoio_tel = $apoiador->getTelefone();
								$apoio_id = $apoiador->getId();
						?>
							<tr>
								<td><?php echo $apoio_nome; ?></td>
								<td><a href="tel:<?php echo $apoio_tel; ?>"><?php echo $apoio_tel; ?></td>
								<td><button class="btn btn-light"><a href="https://api.whatsapp.com/send?phone=55<?php echo $apoio_tel; ?>&text=Olá!" target="_blank"><img src="./img/whatsapp-final.png" width="25"></a></button>
									<button class="btn btn-light"><a href="editarApoiador.php?apoio_id=<?php echo $apoio_id; ?>"><img src="img/edit.png" width="25"></a></button>
									<button class="btn btn-light"><a href="excluirApoiador.php?apoio_id=<?php echo $apoio_id; ?>"><img src="img/delete.png" width="25"></a></button>
								</td>
							</tr>
							<?php } ; ?>
						</tbody>
					</table>

					<?php 
						$anterior = $pagina - 1;
						$proximo = $pagina + 1;
					?>
					<?php if ($num_paginas > 1) { ?>
						<nav aria-label="navigation">
							<ul class="pagination">
								<?php if($anterior != 0){ ?>
									<li class="page-item">
										<a class="page-link" href="gerenciarApoiadores.php?pagina=<?php echo $anterior ?>">Anterior</a>
									</li>
								<?php } ?> 
								<li class="page-item active" aria-current="page">
									<span class="page-link">
										<?php echo $pagina ?>
										<span class="sr-only">(current)</span>
									</span>
								</li>
								<?php if($proximo <= $num_paginas){ ?>
									<li class="page-item">
										<a class="page-link" href="gerenciarApoiadores.php?pagina=<?php echo $proximo ?>">Próxima</a>
									</li>
								<?php } ?> 
							</ul>
						</nav>
					<?php } ?>  
				
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
 // };
?>
