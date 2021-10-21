<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title><?php echo $title ?></title>

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
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="<?php echo site_url() ?>" class="logo"><b>MADA<span>ROUTE</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?php echo site_url('utilisateurfo/deconnexion') ?>"><i class="fa fa-sign-out"></i> Déconnexion</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <!-- <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p> -->
          <h5 class="centered">Bienvenue sur Madaroute</h5>
          <li class="mt">
            <a href="<?php echo site_url() ?>" class="<?php if($contents == 'liste_routes'){ echo "active"; } ?>">
              <i class="fa fa-road"></i>
              <span>Liste des routes</span>
            </a>
          </li>
          <li class="">
            <a href="<?php echo site_url('reparation') ?>" class="<?php if($contents == 'liste_reparations'){ echo "active"; } ?>">
              <i class="fa fa-gear"></i>
              <span>Historique des réparations</span>
            </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
