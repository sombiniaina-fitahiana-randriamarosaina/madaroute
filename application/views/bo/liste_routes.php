
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-road"></i> Liste des routes</h3>
          </div>
        </div>
        <?php if(isset($_SESSION['message'])) { ?>
          <div class="alert alert-danger"><?php echo $_SESSION['message'] ?></div>
        <?php } ?>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Numero</th>
                  <th class="text-center">Ville Départ</th>
                  <th class="text-center">Ville Arrivée</th>
                  <th class="text-center">Distance (km)</th>
                  <th class="text-center">Etat</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($routes as $route) { ?>
                <tr>
                  <td><a href="<?php echo admin_url("portion/liste/".$route->idroute) ?>"><?php echo $route->numroute ?><a></td>
                  <td><?php echo $route->villedepart ?></td>
                  <td><?php echo $route->villearrivee ?></td>
                  <td class="text-right"><?php echo format_decimal($route->distance) ?></td>
                  <td><?php echo $route->etat ?></td>
                  <td>
              <?php if($route->etat == Route::route_modifiable) { ?>
                    <a href="<?php echo admin_url("route/modification/".$route->idroute) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("route/supprimer_route/".$route->idroute) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
              <?php } ?>
                  </td>
                  <td>
              <?php if($route->etat == Route::route_modifiable) { ?>
                    <a href="<?php echo admin_url("route/valider_route/".$route->idroute) ?>"><button class="btn btn-xs btn-success">Valider</button></a>
              <?php } ?>      
                  </td>
                </tr>
        <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
