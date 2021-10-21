
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-plane"></i> Nouveau Vol</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="<?php echo admin_url('vol_admin/insert_vol') ?>" class="form-horizontal style-form" method="post">
              <div class="form-group">
                <label class="col-md-2 control-label">Avion</label>
                <div class="col-md-4">
                  <select name="idavion" class="form-control">
            <?php foreach($avions as $avion) { ?>
                    <option value="<?php echo $avion->idavion ?>"><?php echo $avion->nomavion ?></option>
            <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Trajet</label>
                <div class="col-md-4">
                  <select name="idtrajet" class="form-control">
            <?php foreach($trajets as $trajet) { ?>
                    <option value="<?php echo $trajet->idtrajet ?>"><?php echo $trajet->idtrajet.".".$trajet->villeorigine."-".$trajet->villedestination ?></option>
            <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Date Départ</label>
                <div class="col-md-4">
                  <input type="date" name="datevol" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label">Heure Départ</label>
                <div class="col-md-4">
                  <input type="time" name="heurevol" step="1" class="form-control" />
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-theme">Ajouter ce vol</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
