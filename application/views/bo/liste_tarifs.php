
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-money"></i> Liste des tarifs</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Numero</th>
                  <th class="text-center">Numero Trajet</th>
                  <th class="text-center">Origine Trajet</th>
                  <th class="text-center">Destination Trajet</th>
                  <th class="text-center">Distance Trajet(km)</th>
                  <th class="text-center">Prix(Ar)</th>
                  <th class="text-center">Remise non remboursable</th>
                  <th class="text-center">Remise non modifiable</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($tarifs as $tarif) { ?>
                <tr>
                  <td><?php echo $tarif->idtarif ?></td>
                  <td><?php echo $tarif->idtrajet ?></td>
                  <td><?php echo $tarif->villeorigine ?></td>
                  <td><?php echo $tarif->villedestination ?></td>
                  <td class="text-right"><?php echo format_decimal($tarif->distance) ?></td>
                  <td class="text-right"><?php echo format_decimal($tarif->prix) ?></td>
                  <td class="text-right"><?php echo $tarif->remisenonremboursable ?> %</td>
                  <td class="text-right"><?php echo $tarif->remisenonmodifiable ?> %</td>
                  <td>
                    <a href="<?php echo admin_url("tarif/modification/".$tarif->idtarif) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("tarif/supprimer_tarif/".$tarif->idtarif) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
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
