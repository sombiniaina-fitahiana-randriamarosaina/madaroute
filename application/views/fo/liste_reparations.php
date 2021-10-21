
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-gears"></i> Historique des réparations</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Route</th>
                  <th class="text-center">Pk début</th>
                  <th class="text-center">Pk fin</th>
                  <th class="text-center">Distance</th>
                  <th class="text-center">Montant (Ar)</th>
                  <th class="text-center">Date de réparation</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($reparations as $reparation) { ?>
                <tr>
                  <td><?php echo $reparation->numroute ?></td>
                  <td class="text-right"><?php echo $reparation->pkdebut ?></td>
                  <td class="text-right"><?php echo $reparation->pkfin ?></td>
                  <td class="text-right"><?php echo $reparation->distance ?></td>
                  <td class="text-right"><?php echo format_decimal($reparation->montant) ?></td>
                  <td class="text-right"><?php echo $reparation->datereparation ?></td>
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
