
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-map-marker"></i> Modification du Trajet</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="<?php echo admin_url("trajet/modifier_trajet/".$trajet->idtrajet) ?>" class="form-horizontal style-form" method="post">
              <div class="form-group">
                <label class="col-md-2 control-label">Ville Origine</label>
                <div class="col-md-4">
                  <input type="text" name="villeorigine" value="<?php echo $trajet->villeorigine ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Ville Destination</label>
                <div class="col-md-4">
                  <input type="text" name="villedestination" value="<?php echo $trajet->villedestination ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Distance</label>
                <div class="col-md-4">
                  <input type="text" name="distance" value="<?php echo $trajet->distance ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-warning">Enregistrer ce trajet</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
