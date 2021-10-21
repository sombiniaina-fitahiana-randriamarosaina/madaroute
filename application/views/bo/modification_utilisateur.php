
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-gears"></i> Modification d'un Utilisateur</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-4"></div>
          <div class="col-md-8">
            <form action="" class="form-horizontal style-form" method="post">
              <div class="form-group <?php if(form_error('nom')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Nom</label>
                <div class="col-md-4">
                  <input type="text" name="nom" value=<?php echo $utilisateur->nom ?> class="form-control" >
                  <p class="help-block"><?php echo form_error('nom') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('mail')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Mail</label>
                <div class="col-md-4">
                  <input type="text" name="mail" value=<?php echo $utilisateur->mail ?> class="form-control" >
                  <p class="help-block"><?php echo form_error('mail') ?></p>
                </div>
              </div>
              <div class="form-group <?php if(form_error('mdp')) { echo 'has-error'; } ?>">
                <label class="col-md-2 control-label">Mot de passe</label>
                <div class="col-md-4">
                  <input type="password" name="mdp" class="form-control" />
                  <p class="help-block"><?php echo form_error('mdp') ?></p>
                </div>
              </div>
              <div class="form-group col-md-6 text-center">
                <button type="submit" class="btn btn-warning">Enregistrer cet utilisateur</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
