<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Connexion - Admin - AirMadagascar</title>

  <!-- Favicons -->
  <link href=<?php echo asset_url("img/favicon.png") ?> rel="icon">
  <link href=<?php echo asset_url("img/apple-touch-icon.png") ?> rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href=<?php echo asset_url("lib/bootstrap/css/bootstrap.min.css") ?> rel="stylesheet">
  <!--external css-->
  <link href=<?php echo asset_url("lib/font-awesome/css/font-awesome.css") ?> rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href=<?php echo asset_url("css/style.css") ?> rel="stylesheet">
  <link href=<?php echo asset_url("css/style-responsive.css") ?> rel="stylesheet">

</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" method="post">
        <h2 class="form-login-heading">Connectez-vous</h2>
        <div class="login-wrap">
    <?php if(validation_errors()){ ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
    <?php } ?>
          <input type="text" name="identifiant" class="form-control" placeholder="Email" autofocus>
          <br>
          <input type="password" name="mdp" class="form-control" placeholder="Mot de passe">
          <br>
          <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Connexion</button>
        </div>
      </form>
    </div>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src=<?php echo asset_url("lib/jquery/jquery.min.js") ?>></script>
  <script src=<?php echo asset_url("lib/bootstrap/js/bootstrap.min.js") ?>></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src=<?php echo asset_url("lib/jquery.backstretch.min.js") ?>></script>
  <script>
    $.backstretch("<?php echo asset_url("img/login-bg.jpg") ?>", {
      speed: 500
    });
  </script>
</body>

</html>
