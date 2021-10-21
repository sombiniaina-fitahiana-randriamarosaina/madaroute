
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-plane"></i> Les passagers réels du vol</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <div class="form-horizontal style-form">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label"><strong>Numero Vol</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->numvol ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Avion</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->nomavion ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Places</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->nbplace ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Ville Origine</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->villeorigine ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Ville Destination</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->villedestination ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Distance</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->distance ?> km</p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Tarif</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo format_decimal($vol->prix) ?> Ar</p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Départ</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $vol->dateheurevol ?></p>
                </div>
              </div>
            </div>
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center"><i class="fa fa-user"></i> Nom</th>
                  <th class="text-center"><i class="fa fa-tag"></i> Prenom</th>
                  <th class="text-center"><i class=" fa fa-wheelchair"></i> Type du passager</th>
                  <th class="text-center"><i class=" fa fa-money"></i> Montant (Ar)</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($passagers as $passager) { ?>
                <tr>
                  <td><?php echo $passager->nom ?></td>
                  <td><?php echo $passager->prenom ?></td>
                  <td><?php echo $passager->typepassager ?></td>
                  <td><?php echo format_decimal($passager->montant) ?></td>
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
