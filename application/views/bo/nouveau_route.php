
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-road"></i> Nouvelle Route</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="" class="form-horizontal style-form" method="post">
              <div class="form-group <?php if(form_error('numroute')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Numero de route</label>
                <div class="col-md-4">
                  <input type="text" name="numroute" class="form-control" >
                  <p class="help-block"><?php echo form_error('numroute') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('villedepart')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Ville Départ</label>
                <div class="col-md-4">
                  <input type="text" name="villedepart" class="form-control" >
                  <p class="help-block"><?php echo form_error('villedepart') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('villearrivee')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Ville Arrivée</label>
                <div class="col-md-4">
                  <input type="text" name="villearrivee" class="form-control" />
                  <p class="help-block"><?php echo form_error('villearrivee') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('distance')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Distance</label>
                <div class="col-md-4">
                  <input type="text" name="distance" class="form-control" />
                  <p class="help-block"><?php echo form_error('distance') ?></p>
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-theme">Ajouter cette route</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
