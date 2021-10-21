
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height" id="pdf">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><i class="fa fa-map-marker"></i> Liste des trajets</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-theme" data-toggle="collapse" data-target="#recherche" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
              <i class="fa fa-search"></i> Recherche
            </button>
            <br><br>
            <div class="collapse" id="recherche" style="">
              <div class="card card-body" style="background: #eaeaea; height: 320px">
                <form action="" class="form-horizontal style-form" method="get">
                  <div class="form-group">
                    <label class="col-md-2 control-label">Numero</label>
                    <div class="col-md-4">
                      <input type="text" name="idtrajet" value="<?php echo $search['idtrajet'] ?>" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Ville Origine</label>
                    <div class="col-md-4">
                      <input type="text" name="villeorigine" value="<?php echo $search['villeorigine'] ?>" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Ville Destination</label>
                    <div class="col-md-4">
                      <input type="text" name="villedestination" value="<?php echo $search['villedestination'] ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">Distance entre</label>
                    <div class="col-md-4">
                      <input type="text" name="distancemin" value="<?php echo $search['distancemin'] ?>" class="form-control" />
                    </div>
                    <div class="col-md-1 text-center"><label class="control-label">et</label></div>
                    <div class="col-md-4">
                      <input type="text" name="distancemax" value="<?php echo $search['distancemax'] ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <button type="submit" class="btn btn-success">Rechercher</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7"></div>
          <div class="col-md-5">
            <button class="btn btn-danger" onclick="generatePDF()"><i class="fa fa-file-text-o"></i> Exporter en Pdf</button>
            <a href="<?php echo admin_url('trajet/export_excel') ?>"><button class="btn btn-success"><i class="fa fa-file-text-o"></i> Exporter en Excel</button></a>
            <a href="<?php echo admin_url('trajet/export_csv') ?>"><button class="btn btn-warning"><i class="fa fa-file-text-o"></i> Exporter en Csv</button></a>
          </div>
        </div>
        <div class="row" style="margin-top: 40px">
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-advance table-hover">
              <thead>
                <tr>
                  <th class="text-center"><a href="<?php echo $data_colonne['href_idtrajet'] ?>">Numero <i class="fa <?php echo $data_colonne['icone_idtrajet'] ?>"></i></a></th>
                  <th class="text-center"><a href="<?php echo $data_colonne['href_villeorigine'] ?>">Ville Origine <i class="fa <?php echo $data_colonne['icone_villeorigine'] ?>"></i></th>
                  <th class="text-center"><a href="<?php echo $data_colonne['href_villedestination'] ?>">Ville Destination <i class="fa <?php echo $data_colonne['icone_villedestination'] ?>"></i></th>
                  <th class="text-center"><a href="<?php echo $data_colonne['href_distance'] ?>">Distance (km) <i class="fa <?php echo $data_colonne['icone_distance'] ?>"></i></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($trajets as $trajet) { ?>
                <tr>
                  <td><?php echo $trajet->idtrajet ?></td>
                  <td><?php echo $trajet->villeorigine ?></td>
                  <td><?php echo $trajet->villedestination ?></td>
                  <td class="text-right"><?php echo format_decimal($trajet->distance) ?></td>
                  <td>
                    <a href="<?php echo admin_url("trajet/modification/".$trajet->idtrajet) ?>"><button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button></a>
                    <a href="<?php echo admin_url("trajet/supprimer_trajet/".$trajet->idtrajet) ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                  </td>
                </tr>
        <?php } ?>
              </tbody>
            </table>
          </div>

          <div class="col-md-12">
            <div class="dataTables_paginate paging_bootstrap pagination">
              <ul>
                <li class="prev disabled"><a href="<?php echo admin_url('trajet?page='.($page-1).'&tri_par='.$tri_par.'&ordre='.$ordre.$search_parameters) ?>"><i class="fa fa-angle-left  pagination-left"></i></a></li>
          <?php for($i = 1; $i <= $nb_pages; $i++){ ?>
                <li class="<?php if($page == $i){ echo 'active'; } ?>"><a href="<?php echo admin_url('trajet?page='.$i.'&tri_par='.$tri_par.'&ordre='.$ordre.$search_parameters) ?>"><?php echo $i ?></a></li>
          <?php } ?>
                <li class="next"><a href="<?php echo admin_url('trajet?page='.($page+1).'&tri_par='.$tri_par.'&ordre='.$ordre.$search_parameters) ?>"><i class="fa fa-angle-right  pagination-right"></i></a></li>
              </ul>
            </div>
          </div>

        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <script src="<?php echo asset_url("js/html2pdf.bundle.min.js") ?>"></script>

    <script>
      function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("pdf");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('Export Pdf Trajets');
      }
    </script>
