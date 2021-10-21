
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-gears"></i> Liste des etats de portion</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Etat</th>
                  <th class="text-center">Libellé Etat</th>
                  <th class="text-center">Coût de réparation (en Ar)</th>
                  <th class="text-center">Durée de réparation (en semaines)</th>
                  <th class="text-center">Coefficient de dégradation</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($etatPortions as $etatPortion) { ?>
                <tr>
                  <td><?php echo $etatPortion->etat ?></td>
                  <td><?php echo $etatPortion->libelleetat ?></td>
                  <td class="text-right"><?php echo format_decimal($etatPortion->coutreparation) ?></td>
                  <td class="text-right"><?php echo $etatPortion->dureereparation ?></td>
                  <td class="text-right"><?php echo $etatPortion->coeffdeg." %" ?></td>
                  <td>
                    <a href="<?php echo admin_url("etatPortion/modification/".$etatPortion->idetatportion) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("etatPortion/supprimer_etatPortion/".$etatPortion->idetatportion) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
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
