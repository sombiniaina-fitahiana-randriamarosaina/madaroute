<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Reparation extends Base_Controller  {

    public function __construct() {
        parent::__construct();

        if(!parent::utilisateur_connected()) {
          redirect(site_url());
          return;
        }

        $this->load->model('reparation_model');
    }

    public function index() {
      $data['title'] = 'Historique des réparations';

      $data['contents'] = 'liste_reparations';

      $data['reparations'] = $this->reparation_model->get_reparations();

      $this->load->view('fo/template', $data);
    }

}
?>
