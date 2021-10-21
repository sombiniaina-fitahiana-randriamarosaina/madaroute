
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
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-theme" data-toggle="collapse" data-target="#recherche" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
              <i class="fa fa-search"></i> Recherche
            </button>
            <br><br>
            <div class="collapse" id="recherche" style="">
              <div class="card card-body" style="background: #eaeaea; height: 200px">
                <form action="" class="form-horizontal style-form" method="get">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Ville de départ</label>
                    <div class="col-md-4">
                      <input type="text" name="villedepart" value="<?php echo $search['villedepart'] ?>" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Ville d'arrivée</label>
                    <div class="col-md-4">
                      <input type="text" name="villearrivee" value="<?php echo $search['villearrivee'] ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <button type="submit" class="btn btn-success">Rechercher</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="<?php echo admin_url('routefo/export_excel') ?>"><button class="btn btn-success"><i class="fa fa-file-text-o"></i> Exporter en Excel</button></a>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center"><a href="<?php echo $data_colonne['href_numroute'] ?>">Numero <i class="fa <?php echo $data_colonne['icone_numroute'] ?>"></i></a></th>
                  <th class="text-center">Ville Départ</th>
                  <th class="text-center">Ville Arrivée</th>
                  <th class="text-center">Etat global</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($routes as $route) { ?>
                <tr>
                  <td><a href="<?php echo admin_url("routefo/fiche/".$route->idroute) ?>"><?php echo $route->numroute ?><a></td>
                  <td><?php echo $route->villedepart ?></td>
                  <td><?php echo $route->villearrivee ?></td>
                  <td class="text-right"><?php echo format_decimal($route->etatglobal) ?> %</td>
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
