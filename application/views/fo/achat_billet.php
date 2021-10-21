
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper ite-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-ticket"></i> Achat de Billet</h3>
    <?php if($error){ ?>
            <span style="color: red"><?php echo $msg_error ?></span>
    <?php } ?>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="<?php echo site_url("Billet/insert_billet") ?>" class="form-horizontal style-form" method="get">
              <div class="form-group">
                <label class="col-md-3 control-label">Personne</label>
                <div class="col-md-4">
                  <select name="idpersonne" class="form-control">
            <?php foreach($personnes as $personne) { ?>
                    <option value="<?php echo $personne->idpersonne ?>"><?php echo $personne->nom." ".$personne->prenom ?></option>
            <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Vol</label>
                <div class="col-md-4">
                  <select name="idvol" class="form-control">
                    <?php foreach($vols as $vol) { ?>
                            <option value="<?php echo $vol->idvol ?>"><?php echo $vol->numvol ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Type du passager</label>
                <div class="col-md-4">
                  <select name="idtypepassager" class="form-control">
                    <?php foreach($typePassagers as $typePassager) { ?>
                            <option value="<?php echo $typePassager->idtypepassager ?>"><?php echo $typePassager->typepassager." (".$typePassager->agemin." - ".$typePassager->agemax.")" ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Remboursable</label>
                <div class="col-md-4">
                  <input type="hidden" name="isremboursable" value="false">
                  <input type="checkbox" name="isremboursable" value="true" class="checkbox form-control" checked style="width: 20px">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Modifiable</label>
                <div class="col-md-4">
                  <input type="hidden" name="ismodifiable" value="false">
                  <input type="checkbox" name="ismodifiable" value="true" class="checkbox form-control" checked style="width: 20px">
                </div>
              </div>
              <div class="form-group col-md-7 text-center">
                <button type="submit" class="btn btn-theme">Acheter ce billet</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
