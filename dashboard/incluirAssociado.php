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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
<!-- Custom Theme files -->
<link href="estilo-admin.css" rel='stylesheet' type='text/css' />	
<script src="../js/jquery.min.js"> </script>
<!--webfonts-->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700|Cinzel+Decorative:400,700' rel='stylesheet' type='text/css'>
<!--//webfonts-->


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="date/jquery-ui.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script>
 $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "c-70:c"
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
  						<li class="active">Cadastrar Associado</li>
					</ol>
        			<h3 class="text-left">Cadastrar Associado</h3>
        			<p>&nbsp;</p>
                     <?php
                      if(isset($_GET['erro']) && $_GET['erro']=='associado-ja-cadastrado'){ ?>
                        <div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Associado já cadastrado anteriormente! Evite cadastros em duplicidade.</strong></div>
                      <?php }; ?>
                    <div id="tabela">
                    <form action="cadastrar.php" enctype="multipart/form-data" method="POST" name="form1">
                      <table class="table table-striped" align="left">
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Nome:</td>
                          <td><span id="sprytextfield1">
                            <input type="text" name="ass_nome" value="" size="100%" required>
                          <span class="textfieldRequiredMsg">Preenchimento obrigatório!</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>CPF:</td>
                          <td><span id="sprytextfield2">
                          <input type="text" name="ass_cpf" value="" size="32">
                          <span class="textfieldRequiredMsg">Preenchimento obrigatório!</span><span class="textfieldInvalidFormatMsg">Formato inválido</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Data de Nascimento:</td>
                          <td><input type="text" name="ass_data_nasc" id="datepicker" value="" size="32"></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Profissão:</td>
                          <td><label for="ass_prof"></label>
                          <input type="text" name="ass_prof" id="ass_prof"></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Endereço:</td>
                          <td><span id="sprytextarea1">
                            <textarea name="ass_end" cols="55" rows="6"></textarea>
                          <span class="textareaRequiredMsg">Preenchimento obrigatório!</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>CEP:</td>
                          <td><span id="sprytextfield3">
                          <input type="text" name="ass_cep" value="" size="32">
                          <span class="textfieldInvalidFormatMsg">Formato inválido</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Telefone:</td>
                          <td><span id="sprytextfield4">
                          <input type="text" name="ass_tel" value="" size="32">
                          <span class="textfieldRequiredMsg">Preenchimento obrigatório!</span><span class="textfieldInvalidFormatMsg">Formato inválido</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>E-mail:</td>
                          <td><span id="sprytextfield5">
                          <input type="text" name="ass_email" value="" size="40">
                          <span class="textfieldInvalidFormatMsg">E-mail inválido.</span></span></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Opção de pagamento:</td>
                          <td valign="baseline"><table>
                            <tr>
                              <td><input type="radio" name="ass_paga" value="carne" >
                                Carnê</td>
                            </tr>
                            <tr>
                              <td><input type="radio" name="ass_paga" value="boleto" >
                                Boleto</td>
                            </tr>
                            <tr>
                              <td><input type="radio" name="ass_paga" value="cartao" >
                                Cartão</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>Status:</td>
                          <td><select name="ass_status">
                            <option value="ok" <?php if (!(strcmp("ok", ""))) {echo "SELECTED";} ?>>Em dia</option>
                            <option value="atraso" <?php if (!(strcmp("atraso", ""))) {echo "SELECTED";} ?>>Atrasado</option>
                            <option value="desfiliado" <?php if (!(strcmp("desfiliado", ""))) {echo "SELECTED";} ?>>Desfiliado</option>
                                                        <option value="pendente" <?php if (!(strcmp("pendente", ""))) {echo "SELECTED";} ?>>Pendente</option>

                          </select></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr valign="baseline">
                          <td align="center" valign="middle" nowrap>&nbsp;</td>
                          <input type="hidden" name="cadastrar-associado" value="form1">
                          <td><input type="submit"  class="btn btn-info"value="Cadastrar!"></td>
                        </tr>
                      </table>
                      
                      
                    </form>
                    <p>&nbsp;</p>
                    </div>
                </div>
        
        
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"000.000.000-00", useCharacterMasking:true, hint:"somente numeros"});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"00.000-000", useCharacterMasking:true, hint:"somente n\xFAmeros", isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "phone_number", {format:"phone_custom", pattern:"(00)00000-0000", useCharacterMasking:true, hint:"(00)00000-0000"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email", {isRequired:false});
</script>
</body>
</html>

<?php } ?>