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
  
  if (isset($_GET['ass_id'])){
      $associado = $associadosDAO->buscaUm($_GET['ass_id']);
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
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<!--webfonts-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="date/jquery-ui.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700|Cinzel+Decorative:400,700' rel='stylesheet' type='text/css'>
 <link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css">
<!--//webfonts-->
<script>
 $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "c-60:c"
    });
  });
  </script>

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
  						<li class="active">Editar Associado</li>
					</ol>
        			<h3 class="text-left">Editar Associado</h3>
        			<p>&nbsp;</p>
            	<form action="editar.php" name="form1" method="POST" enctype="multipart/form-data" id="form1">	
               <div class="row"><input name="ass_id" type="hidden" id="ass_id" value="<?php echo $associado['ass_id']; ?>">
                 <div class="col-md-6">
                   <div class="form-group text-left">
                     <label>Nome:</label>
                     <input name="ass_nome" type="text" class="form-control" id="ass_nome" value="<?php echo $associado['ass_nome']; ?>" required>
                   </div>
            		<div class="form-group text-left">
                      <label>CPF:</label>
                      <input name="ass_cpf" type="text" class="form-control" id="ass_cpf" value="<?php echo $associado['ass_cpf']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                      <label>Data de nascimento:</label>
                      <input name="ass_data_nasc" type="text" class="form-control" id="datepicker" value="<?php echo $associado['ass_data_nasc']; ?>" required>
                    </div>
                    <div class="form-group text-left">
                      <label>Profissão:</label>
                      <input name="ass_prof" type="text" class="form-control" id="ass_prof" value="<?php echo $associado['ass_prof']; ?>">
                    </div>
                    <div class="form-group text-left">
                      <label>Endereço:</label>
                      <textarea name="ass_end" class="form-control" id="ass_end"><?php echo $associado['ass_end']; ?></textarea>
                    </div>
                    <div class="form-group text-left">
                      <label>CEP:</label>
                      <input name="ass_cep" type="text" class="form-control" id="ass_cep" value="<?php echo $associado['ass_cep']; ?>">
                    </div>
                 </div>  
              
               	 <div class="col-md-6">
               
                    <div class="form-group text-left">
                      <label>Telefone:</label>
                      <input name="ass_tel" type="text" class="form-control" id="ass_tel" value="<?php echo $associado['ass_tel']; ?>">
                    </div>
                    <div class="form-group text-left">
                      <label>Email:</label>
                      <input name="ass_email" type="text" class="form-control" id="ass_email" value="<?php echo $associado['ass_email']; ?>" required>
                    </div>
                    <label>Opção de pagamento:
                    </label><br>
                   <span id="spryradio1" class="text-left">
                    <label>
                      <input <?php if (!(strcmp($associado['ass_paga'],"carne"))) {echo "checked=\"checked\"";} ?> type="radio" name="ass_paga" value="carne" id="opcao_0">
                      Carnê</label>
                    <br>
                    <label>
                      <input <?php if (!(strcmp($associado['ass_paga'],"cartao"))) {echo "checked=\"checked\"";} ?> type="radio" name="ass_paga" value="cartao" id="opcao_1">
                      Cartão</label>
                    <br>
                    <label>
                      <input <?php if (!(strcmp($associado['ass_paga'],"boleto"))) {echo "checked=\"checked\"";} ?> type="radio" name="ass_paga" value="boleto" id="opcao_2">
                      Boleto</label>
                    <br>
                    <span class="radioRequiredMsg">Por favor, selecione uma opção.</span></span>
<div class="form-group">
                  <label for="sel1">Status:</label>
                  <select name="ass_status" class="form-control" id="ass_status">
                    <option value="ok" selected="selected" <?php if (!(strcmp("ok", $associado['ass_status']))) {echo "selected=\"selected\"";} ?>>Em dia</option>
                    <option value="atraso" <?php if (!(strcmp("atraso", $associado['ass_status']))) {echo "selected=\"selected\"";} ?>>Atrasado</option>
                    <option value="desfiliado" <?php if (!(strcmp("desfiliado", $associado['ass_status']))) {echo "selected=\"selected\"";} ?>>Desfiliado</option>
<option value="pendente" <?php if (!(strcmp("pendente", $associado['ass_status']))) {echo "selected=\"selected\"";} ?>>Pendente</option>
                      </select>
                   </div> 
                    
               	   
  
                 </div>     
                      
              </div>
                  <input type="hidden" name="editar-associado" value="form1">
                 <button type="submit" class="btn btn-primary pull-left">Atualizar!</button>
                    
            	</form>
        
        	</div>
		</div>
	  </div>   
	  </div>
	
	
			
</div>	
<!----family---><!---- footer --->
			
			<div class="copy">
		              <p>&copy; 2015. Desenvolvido por <a href="mailto:brandao_lopes@live.com">Bruno Brandão</a> </p>
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

<script type="text/javascript">
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"000.000.000-00", useCharacterMasking:true, hint:"somente numeros"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"00.000-000", useCharacterMasking:true, hint:"somente n\xFAmeros", isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "phone_number", {format:"phone_custom", pattern:"(00)00000-0000", useCharacterMasking:true, hint:"(00)00000-0000"});
</script>
</body>
</html>
<?php } ?>
