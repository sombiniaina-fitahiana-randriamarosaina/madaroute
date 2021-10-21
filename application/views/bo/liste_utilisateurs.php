
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-gears"></i> Liste des utilisateurs</h3>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center">Nom</th>
                  <th class="text-center">Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($utilisateurs as $utilisateur) { ?>
                <tr>
                  <td><?php echo $utilisateur->nom ?></td>
                  <td><?php echo $utilisateur->mail ?></td>
                  <td>
                    <a href="<?php echo admin_url("utilisateur/modification/".$utilisateur->idutilisateur) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("utilisateur/supprimer_utilisateur/".$utilisateur->idutilisateur) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
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
