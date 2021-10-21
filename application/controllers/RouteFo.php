<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class RouteFo extends Base_Controller  {

    public function __construct() {
        parent::__construct();

        if(!parent::utilisateur_connected()) {
          redirect(site_url());
          return;
        }

        $this->load->model('route_model');
        $this->load->model('portion_model');
        $this->load->model('budget_model');
        $this->load->model('reparation_model');
    }

    public function index() {
      $data['title'] = 'Liste des Routes';

      $data['contents'] = 'liste_routes';

      $search = array(
        'villedepart' => $this->input->get('villedepart'),
        'villearrivee' => $this->input->get('villearrivee')
      );

      $tri_par = 'numroute';

      $ordre = 'asc';
      if(isset($_GET['ordre']) && $_GET['ordre'] == 'desc') {
        $ordre = $this->input->get('ordre');
      }

      $data['routes'] = $this->route_model->get_routes_etatGlobal($search, $ordre);
      $data['ordre'] = $ordre;
      $data['search'] = $search;
      $data['search_parameters'] = $this->get_search_parameters();
      $data['data_colonne'] = $this->get_href_icone_colonnes($tri_par, $ordre);

      $this->load->view('fo/template', $data);
    }

    public function export_excel() {
      $this->load->helper('excel');

      $routes = $this->route_model->get_all_routes_etatGlobal();
      export_excel($routes, 'Liste des Routes');
    }

    public function fiche($idroute) {
      $data['title'] = 'Fiche de route';

      $data['contents'] = 'fiche_route';

      $data['route'] = $this->route_model->get_route_fiche($idroute);
      $data['portions'] = $this->route_model->get_route_portions_details($idroute);
      $data['entretienTotal'] = $this->route_model->get_route_entretien_total($idroute);

      $this->load->view('fo/template', $data);
    }

    public function reparer($idportion) {
      $budget = $this->budget_model->get_budget();
      $portion = $this->route_model->get_route_portion_details($idportion);
      if($budget < $portion->montant) {
        $this->session->set_userdata('msg_fiche_route', 'Le budget est inférieur au montant de réparation de cette portion');
        redirect('routefo/fiche/'.$portion->idroute);
        return;
      }

      $this->portion_model->reparer_portion($idportion);

      $nouveau_budget = $budget - $portion->montant;
      $this->budget_model->update_budget($nouveau_budget);

      $reparation = array(
            'idportion' => $idportion,
            'montant' => $portion->montant
      );
      $this->reparation_model->insert_reparation($reparation);

      $this->session->unset_userdata('msg_fiche_route');
      redirect('routefo/fiche/'.$portion->idroute);
    }

    public function get_search_parameters() {
      $search_parameters = '&villedepart='.$this->input->get('villedepart').'&villearrivee='.$this->input->get('villearrivee');
      return $search_parameters;
    }

    public function get_href_icone_colonnes($tri_par, $ordre) {
      $data = array();

      $search_parameters = $this->get_search_parameters();

      // numroute
      if($tri_par == 'numroute' && $ordre == 'asc') {
        $data['href_numroute'] = admin_url('routefo?ordre=desc'.$search_parameters);
      } else {
        $data['href_numroute'] = admin_url('routefo?ordre=asc'.$search_parameters);
      }

      if($tri_par == 'numroute') {
        if($ordre == 'asc') {
          $data['icone_numroute'] = 'fa-sort-asc';
        } else {
          $data['icone_numroute'] = 'fa-sort-desc';
        }
      } else {
        $data['icone_numroute'] = 'fa-sort';
      }
      return $data;
    }

}
?>
