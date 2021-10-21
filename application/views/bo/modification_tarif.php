
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <form action="<?php echo admin_url("tarif/modifier_tarif/".$tarif->idtarif) ?>" method="post">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3><i class="fa fa-money"></i> Nouveau Tarif</h3>
            </div>
          </div>
          <div class="row" style="margin-top: 40px">
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <div class="form-horizontal style-form">
                <div class="form-group">
                  <label class="col-md-2 control-label">Trajet</label>
                  <div class="col-md-4">
                    <select name="idtrajet" class="form-control">
            <?php foreach($trajets as $trajet){ ?>
                      <option value="<?php echo $trajet->idtrajet ?>" <?php if($trajet->idtrajet == $tarif->idtrajet){ echo "selected"; } ?> ><?php echo $trajet->idtrajet ?></option>
            <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Prix (Ar)</label>
                  <div class="col-md-4">
                    <input type="text" name="prix" value="<?php echo $tarif->prix ?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Remise Non Remboursable (%)</label>
                  <div class="col-md-4">
                    <input type="number" name="remisenonremboursable" value="<?php echo $tarif->remisenonremboursable ?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Remise Non Modifiable (%)</label>
                  <div class="col-md-4">
                    <input type="number" name="remisenonmodifiable" value="<?php echo $tarif->remisenonmodifiable ?>" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom: 20px">
              <h3><i class="fa fa-gears"></i> Options du Tarif</h3>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <div class="form-horizontal style-form">
        <?php foreach($optionTarifs as $optionTarif){ ?>
                <div class="form-group">
                  <label class="col-md-2 control-label"><?php echo $optionTarif->typepassager ?> (en %)</label>
                  <div class="col-md-4">
                    <input type="number" name="<?php echo $optionTarif->idtypepassager ?>" value="<?php echo $optionTarif->pourcentageprix ?>" class="form-control" />
                  </div>
                </div>
        <?php } ?>
                <div class="form-group col-md-6 text-center">
                  <button type="submit" class="btn btn-warning">Enregistrer ce tarif</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
