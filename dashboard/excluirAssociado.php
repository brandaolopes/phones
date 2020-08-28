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
  
  if(isset($_GET['ass_id'])){
    $ass_id = $_GET['ass_id'];

    $associado = $associadosDAO->buscaUm($ass_id);
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
  						<li class="active">Excluir Associado</li>
					</ol>
        			<h3 class="text-left">Exclusão de Associado</h3>
       			  <p>&nbsp;</p>
                  <div class="alert alert-danger col-md-6 col-md-offset-1"><strong>Atenção!</strong> Esta ação não poderá ser desfeita.. </div>
                  <p>&nbsp;</p>
                 <div class="row">
                 		<div class="col-md-8 text-left">
                          <strong> Nome:</strong>  <?php echo $associado['ass_nome']; ?><br>
                           <strong>CPF:</strong> <?php echo $associado['ass_cpf']; ?><br>
                          <strong> Data de Nasc.:</strong> <?php $data = 0;
								$data = $associado['ass_data_nasc'];
								echo date('d/m/Y',strtotime($data)); ?><br>
                          <strong> Endereço:</strong> <?php echo $associado['ass_end']; ?>, CEP <?php echo $associado['ass_cep']; ?> <br>
                          <strong> Telefone:</strong> <?php echo $associado['ass_tel']; ?><br>
                          <strong> E-mail:</strong> <?php echo $associado['ass_email']; ?><br>
                          <strong>Forma de pag.:</strong> <?php echo $associado['ass_paga']; ?><br>
                          <strong> Status:</strong> <?php echo $associado['ass_status']; ?><br>
                   		</div>
                 </div>
                 <div class="col-md-4 text-left">
                 	<p>&nbsp;</p>
                   <p>Confirma a exclusão?</p>
                   <p>&nbsp;</p>
                   <form name="form1" enctype="multipart/form-data" method="post" action="excluir.php">
                      <input type="hidden" name="ass_id" value="<?php echo $associado['ass_id']; ?>">
                      <input type="hidden" name="excluir-associado" value="form1">
                      <input type="submit" class="btn btn-danger" value="Excluir!">
                      <a href="gerenciarAssociados.php"><input type="button" class="btn btn-default" value="Voltar"></a>
                     </form>
                     
                 </div>
                 
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
