
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-road"></i> Modification de la Portion de la route <?php echo $route->numroute ?> </h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="" class="form-horizontal style-form" method="post">
              <input type="hidden" name="idroute" value="<?php echo $portion->idroute ?>">
              <div class="form-group <?php if(form_error('pkdebut')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Pk Début</label>
                <div class="col-md-4">
                  <input type="text" name="pkdebut" value="<?php echo $portion->pkdebut ?>" class="form-control" >
                  <p class="help-block"><?php echo form_error('pkdebut') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('pkfin')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Pk Fin</label>
                <div class="col-md-4">
                  <input type="text" name="pkfin" value="<?php echo $portion->pkfin ?>" class="form-control" >
                  <p class="help-block"><?php echo form_error('pkfin') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('idetatportion')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Etat de portion</label>
                <div class="col-md-4">
                  <select name="idetatportion" class="form-control">
                    <?php foreach($etatPortions as $etatPortion) { ?>
                      <option value="<?php echo $etatPortion->idetatportion ?>" <?php if($etatPortion->idetatportion == $portion->idetatportion){ echo 'selected'; } ?> ><?php echo $etatPortion->etat." (". $etatPortion->libelleetat .")" ?></option>
                    <?php } ?>
                  </select>
                  <p class="help-block"><?php echo form_error('idetatportion') ?></p>
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-warning">Enregistrer cette portion</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
