

    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-road"></i> Fiche de la route <?php echo $route->numroute ?></h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <div class="form-horizontal style-form">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label"><strong>Numero</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $route->numroute ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Ville de départ</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $route->villedepart ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Ville d'arrivée</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $route->villearrivee ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Distance (km)</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo $route->distance ?></p>
                </div>
                <label class="col-lg-2 col-sm-2 control-label"><strong>Etat Global</strong></label>
                <div class="col-lg-10">
                  <p class="form-control-static"><?php echo format_decimal($route->etatglobal) ?> %</p>
                </div>
              </div>
            </div>

            <canvas id="route" width="1200" height="100" style="margin-left: 10px"></canvas>

            <?php if(isset($_SESSION['msg_fiche_route'])) { ?>
              <div class="alert alert-danger"><?php echo $_SESSION['msg_fiche_route'] ?></div>
            <?php } ?>

            <div class="row">
              <div class="col-md-10"></div>
              <div class="col-md-2">
                <button class="btn btn-danger" onclick="generatePDF()"><i class="fa fa-file-text-o"></i> Exporter en Pdf</button>
              </div>
            </div><br>

            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center"><i class="fa fa-map-marker"></i> Pk Début</th>
                  <th class="text-center"><i class="fa fa-map-marker"></i> Pk Fin</th>
                  <th class="text-center"><i class=" fa fa-arrows-h"></i> Distance</th>
                  <th class="text-center"><i class=" fa fa-heart"></i> Etat</th>
                  <th class="text-center"><i class="fa fa-money"></i> Coût réparation (Ar)</th>
                  <th class="text-center"><i class="fa fa-calendar"></i> Durée réparation 1km (semaines)</th>
                  <th class="text-center"><i class="fa fa-money"></i> Montant (Ar)</th>
                  <th class="text-center"><i class="fa fa-calendar"></i> Ensemble durée réparation (semaines)</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($portions as $portion) { ?>
                <tr>
                  <td class="text-right"><?php echo $portion->pkdebut ?></td>
                  <td class="text-right"><?php echo $portion->pkfin ?></td>
                  <td class="text-right"><?php echo $portion->distance ?></td>
                  <td><?php echo $portion->etat." (".$portion->libelleetat.")" ?></td>
                  <td class="text-right"><?php echo format_decimal($portion->coutreparation) ?></td>
                  <td class="text-right"><?php echo format_int($portion->dureereparation) ?></td>
                  <td class="text-right"><?php echo format_decimal($portion->montant) ?></td>
                  <td class="text-right"><?php echo format_int($portion->dureereparationensemble) ?></td>
                  <td>
            <?php if($portion->etat != 1){ ?>
                    <a href="<?php echo admin_url("routefo/reparer/".$portion->idportion) ?>"><button class="btn btn-xs btn-success">Réparer</button></a>
            <?php } ?>
                  </td>
                </tr>
        <?php } ?>

                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total:</td>
                  <td class="text-right"><?php echo format_decimal($entretienTotal->montanttotal) ?></td>
                  <td class="text-right"><?php echo format_int($entretienTotal->dureereparationtotal) ?></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <div class="row">

        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <script>
      var canvas = document.getElementById("route");
      var ctx = canvas.getContext("2d");

      var portions = <?php echo json_encode($portions); ?>;

      var x = 10;
      for(var i = 0; i<portions.length; i++) {
        var longueur = portions[i].distance * 2;

        ctx.beginPath();
        ctx.rect(x, 10, longueur, 50);
        ctx.fillStyle = portions[i].color;
        ctx.fill();
        ctx.fillStyle = "black";
        ctx.font = "10pt Calibri,Geneva,Arial";
        ctx.fillText(Math.round(portions[i].pkdebut) + " km", x, 80);
        ctx.closePath();

        x = x + longueur;
      }
    </script>

    <script src="<?php echo asset_url("js/html2pdf.bundle.min.js") ?>"></script>

    <script>
      function generatePDF() {
        var numroute = <?php echo json_encode($route->numroute); ?>;
        const element = document.getElementById("pdf");

        var opt = {
          margin:       0,
          filename:     'Export Pdf Fiche route ' + numroute,
          html2canvas:  { scale: 2 },
          jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
        };

        html2pdf()
          .set(opt)
          .from(element)
          .save();
      }
    </script>
