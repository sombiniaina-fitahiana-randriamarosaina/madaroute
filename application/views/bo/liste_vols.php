
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-plane"></i> Liste des vols</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Numero Vol</th>
                  <th class="text-center">Avion</th>
                  <th class="text-center">Places</th>
                  <th class="text-center">Dispo</th>
                  <th class="text-center">Origine</th>
                  <th class="text-center">Destination</th>
                  <th class="text-center">Distance(km)</th>
                  <th class="text-center">Tarif(Ar)</th>
                  <th class="text-center">Départ</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($vols as $vol) { ?>
                <tr>
                  <td><?php echo $vol->numvol ?></td>
                  <td><?php echo $vol->nomavion ?></td>
                  <td class="text-right"><?php echo $vol->nbplace ?></td>
                  <td class="text-right"><?php echo $vol->nbbilletdispo ?></td>
                  <td><?php echo $vol->villeorigine ?></td>
                  <td><?php echo $vol->villedestination ?></td>
                  <td class="text-right"><?php echo format_decimal($vol->distance) ?></td>
                  <td class="text-right"><?php echo format_decimal($vol->prix) ?></td>
                  <td><?php echo $vol->dateheurevol ?></td>
                  <td>
                    <a href="<?php echo admin_url("vol_admin/modification/".$vol->idvol) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("vol_admin/supprimer_vol/".$vol->idvol) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
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
