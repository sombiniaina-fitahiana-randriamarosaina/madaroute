
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-road"></i> Liste des portions de la route <?php echo $route->numroute ?></h3>
          </div>
        </div>

  <?php if($route->etat == Portion::route_modifiable) { ?>
        <div class="row">
          <div class="col-md-2">
            <a href="<?php echo admin_url('portion/nouveau/'.$route->idroute) ?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Nouvelle portion</button></a>
          </div>
        </div>
  <?php } ?>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Pk Début</th>
                  <th class="text-center">Pk Fin</th>
                  <th class="text-center">Etat</th>
                  <th class="text-center">Libellé état</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($portions as $portion) { ?>
                <tr>
                  <td class="text-right"><?php echo $portion->pkdebut ?></td>
                  <td class="text-right"><?php echo $portion->pkfin ?></td>
                  <td class="text-right"><?php echo $portion->etat ?></td>
                  <td><?php echo $portion->libelleetat ?></td>
                  <td>
              <?php if($route->etat == Portion::route_modifiable) { ?>
                    <a href="<?php echo admin_url("portion/modification/".$portion->idportion) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("portion/supprimer_portion/".$portion->idportion) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
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
