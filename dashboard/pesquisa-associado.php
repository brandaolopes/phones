
<?php

session_start();
ob_start();

if(!isset($_SESSION['admin'])){

	header ('location: index.php?erro=login');
  
  }else{
  
	require_once '../class/DAO/Conexao.class.php';
	require_once '../class/DAO/Usuarios.php';
	require_once '../class/DAO/Associados.php';
   
	$id = $_SESSION['admin'];
  
	$usuarioDAO = new UsuarioDAO;
	$associadosDAO = new AssociadosDAO;
  
	$usuario = $usuarioDAO->buscaUm($id);

	//Paginação
	$num_associados = $associadosDAO->contaAssociados();
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$num_paginas = ceil($num_associados/20);
	$inicio = (20*$pagina)-20;

    if (isset($_POST['pesquisa'])){
        $associados = $associadosDAO->buscaVarios($_POST['pesquisa']);
    }else{
        $associados = $associadosDAO->listarAssociados($inicio);
    }
	

?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>PATHWORK-CE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="PATHWORK-CE" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="estilo-admin.css" rel='stylesheet' type='text/css' />	
<script src="../js/jquery.min.js"> </script>
<!--webfonts-->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700|Cinzel+Decorative:400,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
	<!--start-home-->
	<div id="home" class="header">
		<div class="header-bottom">
			<div class="container">
				<div class="logo">
					<a href="../index.php"><img src="../images/logo.png" width="300"></a>
				</div>
				<span class="menu"></span>
				<div class="top-menu">
					<h3>Área administrativa</h3>
                    <p>Olá, <?php echo $usuario['usu_nome'] ?>!</p>
				</div>
			
				<div class="clearfix"></div>
			</div>
		</div>

	<div class="banner">
		
        <div id="conteudo">
        	<div class="panel">
        		<div class="panel-body">
        			<ol class="breadcrumb text-left">
                        <li><a href="pos-index.php">Início</a></li>
                        <li><a href="gerenciarAssociados.php">Gerenciar Associados</a></li>
  						<li class="active">Pesquisa</li>
					</ol>
        			<h3 class="text-left">Gerenciar Associados</h3>
                  <form action="pesquisa-associado.php" method="post" class="navbar-form navbar-right" role="Buscar Associado">
						<div class="form-group">
						<input name="pesquisa" type="text" class="form-control" id="pesquisa" placeholder="Buscar Associado">
						</div>
						<button type="submit" class="btn btn-default">Procurar</button>
				  </form>
                    
       			  <p>&nbsp;</p>
                  <p class="pull-left">
                    <a href="incluirAssociado.php"><input type="button" class="btn btn-primary" value="Novo Associado">
                    </a>
                  </p><br>
                  <p>&nbsp;</p>
             <div id="tabela">
                 <p>Listando associados com o termo '<?php echo $_POST['pesquisa'] ?>'</p>
                  <table class="table table-bordered table-striped" width="85%" border="1" cellspacing="5" cellpadding="5">
					<thead>
					<tr align="center" valign="middle" bgcolor="#1FADC5">
						<td width="25%"><strong>Nome</strong></td>
						<td><strong>CPF</strong></td>
						<td><strong>E-mail</strong></td>
						<td width="12%"><strong>Telefone</strong></td>
						
						<td><strong>Status</strong></td>
						<td width="20%"><strong>Opções</strong></td>
					</tr>
					</thead>
					<tbody>
						<?php foreach($associados as $associado) {
							$ass_nome = $associado->getNome();
							$ass_cpf = $associado->getCpf();
							$ass_email = $associado->getEmail();
							$ass_tel = $associado->getTelefone();
							$ass_pagamento = $associado->getPagamento();
							$ass_status = $associado->getStatus();
							$ass_id = $associado->getId();
							?>
						<tr>
							<td><?php echo $ass_nome; ?></td>
							<td><?php echo $ass_cpf; ?></td>
							<td><?php echo $ass_email; ?></td>
							<td><?php echo $ass_tel; ?></td>
							
							<td><?php echo $ass_status; ?></td>
							<td><button class="btn btn-default"><a href="verAssociado.php?ass_id=<?php echo $ass_id; ?>"><img src="img/lupa_256x256.png" width="25"></a></button>
							<button class="btn btn-default"><a href="editarAssociado.php?ass_id=<?php echo $ass_id; ?>"><img src="img/edit.png" width="25"></a></button>
							<button class="btn btn-default"><a href="excluirAssociado.php?ass_id=<?php echo $ass_id; ?>"><img src="img/delete.png" width="25"></a></button></td>
						</tr>
						<?php } ; ?>
					</tbody> 
                 </table>
			</div>
			
		<?php 
			$anterior = $pagina - 1;
			$proximo = $pagina + 1;
		?>
		<?php if ($num_paginas > 1) { ?>
        <ul class="pagination pull-left">
			<?php if($anterior != 0){ ?>
			  <li><a href="gerenciarAssociados.php?pagina=<?php echo $anterior ?>">&laquo;</a></li>
			<?php } ?>  
			  <li class="active"><a href="#"><?php echo $pagina ?><span class="sr-only">(current)</span></a></li>
			<?php if($proximo <= $num_paginas){ ?>
			 <li><a href="gerenciarAssociados.php?pagina=<?php echo $proximo ?>">&raquo;</a></li>
			<?php } ?>
		</ul>
		<?php } ?>   
            
           	  </div>
        
        
        	</div>
		</div>
			</div>   
		</div>
	
	
			
</div>	
<!----family---><!---- footer --->
			
			<div class="copy">
		              <p>&copy; <?php echo date('Y'); ?>. Desenvolvido por <a href="mailto:brandao_lopes@live.com">Bruno Brandão</a> </p>
		            </div>
			<!--start-smoth-scrolling-->
			<script type="text/javascript">
								jQuery(document).ready(function($) {
									$(".scroll").click(function(event){		
										event.preventDefault();
										$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
									});
								});
								</script>
							<!--start-smoth-scrolling-->
						<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
		<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html>
<?php
  };
?>
