
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-gears"></i> Modification de l'Etat de portion</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="" class="form-horizontal style-form" method="post">
              <div class="form-group <?php if(form_error('etat')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Etat</label>
                <div class="col-md-4">
                  <input type="text" name="etat" value="<?php echo $etatPortion->etat ?>" class="form-control" >
                  <p class="help-block"><?php echo form_error('etat') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('libelleetat')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Libellé d'état</label>
                <div class="col-md-4">
                  <input type="text" name="libelleetat" value="<?php echo $etatPortion->libelleetat ?>" class="form-control" >
                  <p class="help-block"><?php echo form_error('libelleetat') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('coutreparation')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Coût de réparation</label>
                <div class="col-md-4">
                  <input type="text" name="coutreparation" value="<?php echo $etatPortion->coutreparation ?>" class="form-control" />
                  <p class="help-block"><?php echo form_error('coutreparation') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('dureereparation')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Durée de réparation</label>
                <div class="col-md-4">
                  <input type="text" name="dureereparation" value="<?php echo $etatPortion->dureereparation ?>" class="form-control" />
                  <p class="help-block"><?php echo form_error('dureereparation') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('coeffdeg')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Coefficient de dégradation</label>
                <div class="col-md-4">
                  <input type="text" name="coeffdeg" value="<?php echo $etatPortion->coeffdeg ?>" class="form-control" />
                  <p class="help-block"><?php echo form_error('coeffdeg') ?></p>
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-warning">Enregistrer cet état de portion</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
