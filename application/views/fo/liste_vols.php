
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-plane"></i> Les prochains vols</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center"><i class="fa fa-tag"></i> NumVol</th>
                  <th class="text-center"><i class="fa fa-plane"></i> Avion</th>
                  <th class="text-center"><i class=" fa fa-wheelchair"></i> Places</th>
                  <th class="text-center"><i class=" fa fa-ticket"></i> Dispo</th>
                  <th class="text-center"><i class=" fa fa-map-marker"></i> Origine</th>
                  <th class="text-center"><i class=" fa fa-map-marker"></i> Destination</th>
                  <th class="text-center"><i class=" fa fa-long-arrow-right"></i> Distance(km)</th>
                  <th class="text-center"><i class=" fa fa-money"></i> Tarif(Ar)</th>
                  <th class="text-center"><i class=" fa fa-calendar"></i> Départ</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($vols as $vol) { ?>
                <tr>
                  <td><?php echo $vol->numvol ?></td>
                  <td><?php echo $vol->nomavion ?></td>
                  <td class="text-right"><?php echo format_int($vol->nbplace) ?></td>
                  <td class="text-right"><?php echo format_int($vol->nbbilletdispo) ?></td>
                  <td><?php echo $vol->villeorigine ?></td>
                  <td><?php echo $vol->villedestination ?></td>
                  <td class="text-right"><?php echo format_decimal($vol->distance) ?></td>
                  <td class="text-right"><?php echo format_decimal($vol->prix) ?></td>
                  <td><?php echo $vol->dateheurevol ?></td>
                  <td>
                    <a href="<?php echo site_url("vol/liste_passagers_previsionnels/".$vol->idvol) ?>"><button class="btn btn-info btn-xs">Passagers prévisionnels</button></a>
                    <a href="<?php echo site_url("vol/liste_passagers_reels/".$vol->idvol) ?>"><button class="btn btn-theme btn-xs">Passagers réels</button></a>
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
