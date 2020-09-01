
<?php
 session_start();
 ob_start();

 if(isset($_SESSION['admin'])){
     header ('location: ../dashboard/index.php');
 };
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="POST" action="login.php">
      <img class="mb-4" src="../dashboard/img/handshake-icon.png" alt="" width="72" height="72">
      <h4 class="h5 mb-3 font-weight-normal">Por favor, entre com seus dados de acesso</h4>
      <?php
        if(isset($_GET['erro']) && $_GET['erro']=='login-invalido'){ ?>
            <div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>E-mail ou senha inválidos!</strong><br>Por favor, tente novamente.</div>
      <?php }; ?>
      <?php
        if(isset($_GET['erro']) && $_GET['erro']=='captcha'){ ?>
            <div class='animated shake alert alert-danger alert-dismissible' style='border:1px solid red; text-align: center; margin-top: 10px;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Verificação inválida!</strong><br>Por favor, marque a caixa "não sou um robô".</div>
      <?php }; ?>
      <?php
        if(isset($_GET['erro']) && $_GET['erro']=='login'){ ?>
            <div class='animated shake alert alert-info alert-dismissible' style='border:1px solid blue; text-align: center; margin-top: 10px;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Página com acesso restrito!</strong><br>Por favor, faça login para continuar.</div>
      <?php }; ?>
      <?php
        if(isset($_GET['logout']) && $_GET['logout']=='sucesso'){ ?>
            <div class='animated shake alert alert-info alert-dismissible' style='border:1px solid blue; text-align: center; margin-top: 10px;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Logout realizado com sucesso!</strong></div>
      <?php }; ?>

      <label for="login" class="sr-only">E-mail</label>
      <input type="email" id="login" class="form-control" name="login" placeholder="E-mail" required autofocus>
      <label for="senha" class="sr-only">Senha</label>
      <input type="password" id="senha" class="form-control" name="senha" placeholder="Senha" required>
      <!----captcha--->
      <div class="form-group">
          <div class="g-recaptcha" data-sitekey="6LfLUMYZAAAAAFB-TWeR-XIwNbCt9Vk-F71jKopk"></div>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">Desenvolvido por <a href="mailto:brandao_lopes@live.com">Bruno Brandão</a> &copy;2020</p>
    </form>
    
    <?php foreach ($_POST as $key => $value) { echo '<p><strong>' . $key.':</strong> '.$value.'</p>'; }?>
    <!-- Captcha -->
    <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
</body>
</html>
