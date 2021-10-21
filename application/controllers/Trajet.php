<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Trajet extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('trajet_model');

        $this->load->library('form_validation');
    }

    public function index() {
      $data['title'] = 'Liste des Trajets';

      $data['contents'] = 'liste_trajets';

      $search = array(
        'idtrajet' => $this->input->get('idtrajet'),
        'villeorigine' => $this->input->get('villeorigine'),
        'villedestination' => $this->input->get('villedestination'),
        'distancemin' => $this->input->get('distancemin'),
        'distancemax' => $this->input->get('distancemax')
      );

      $nb_pages = $this->trajet_model->get_nb_pages($search);

      $page = 1;
      if(isset($_GET['page'])) {
        $page = $this->input->get('page');
        if($page < 1){
          $page = 1;
        } else if($page > $nb_pages) {
          $page = $nb_pages;
        }
      }

      $tri_par = 'idtrajet';
      if(isset($_GET['tri_par'])) {
        $tri_par = $this->input->get('tri_par');
      }

      $ordre = 'asc';
      if(isset($_GET['ordre'])) {
        $ordre = $this->input->get('ordre');
      }

      $data['trajets'] = $this->trajet_model->get_page_trajets($page, $tri_par, $ordre, $search);
      $data['page'] = $page;
      $data['nb_pages'] = $nb_pages;
      $data['tri_par'] = $tri_par;
      $data['ordre'] = $ordre;
      $data['data_colonne'] = $this->get_href_icone_colonnes($page, $tri_par, $ordre);
      $data['search'] = $search;
      $data['search_parameters'] = $this->get_search_parameters();

      $this->load->view('bo/template', $data);
    }

    public function nouveau() {
      $config = array(
        array(
          'field' => 'villeorigine',
          'label' => "ville d'origine",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'villedestination',
          'label' => "ville de destination",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'distance',
          'label' => "distance",
          'rules' => 'trim|required|numeric|greater_than[0]'
        )
      );

      $this->form_validation->set_rules($config);

      if($this->form_validation->run()) {
        $this->insert_trajet();
      }

      $data['title'] = 'Nouveau Trajet';

      $data['contents'] = 'nouveau_trajet';

      $this->load->view('bo/template', $data);
    }

    public function insert_trajet() {
      $trajet = $this->input->post();

      $this->db->trans_begin();
      if($this->trajet_model->insert_trajet($trajet)) {
        $this->db->trans_commit();
        redirect('trajet');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idtrajet) {
      $data['title'] = 'Modification Trajet';

      $data['contents'] = 'modification_trajet';

      $data['trajet'] = $this->trajet_model->get_trajet($idtrajet);

      $this->load->view('bo/template', $data);
    }

    public function modifier_trajet($idtrajet) {
      $trajet = $this->input->post();

      $this->db->trans_begin();
      if($this->trajet_model->update_trajet($idtrajet, $trajet)) {
        $this->db->trans_commit();
        redirect('trajet');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_trajet($idtrajet) {
      $this->db->trans_begin();
      if($this->trajet_model->supprimer_trajet($idtrajet)) {
        $this->db->trans_commit();
        redirect('trajet');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function export_excel() {
      $this->load->helper('excel');

      $trajets = $this->trajet_model->get_trajets();
      export_excel($trajets, 'Liste des Trajets');
    }

    public function export_csv() {
      $this->load->helper('csv');

      $trajets = $this->trajet_model->get_trajets();
      export_csv($trajets, 'Liste des Trajets');
    }

    public function get_search_parameters() {
      $search_parameters = '&idtrajet='.$this->input->get('idtrajet').'&villeorigine='.$this->input->get('villeorigine')
                            .'&villedestination='.$this->input->get('villedestination').'&distancemin='
                            .$this->input->get('distancemin').'&distancemax='.$this->input->get('distancemax');
      return $search_parameters;
    }

    public function get_href_icone_colonnes($page, $tri_par, $ordre) {
      $data = array();

      $search_parameters = $this->get_search_parameters();

      // idtrajet
      if($tri_par == 'idtrajet' && $ordre == 'asc') {
        $data['href_idtrajet'] = admin_url('trajet?page='.$page.'&tri_par=idtrajet&ordre=desc'.$search_parameters);
      } else {
        $data['href_idtrajet'] = admin_url('trajet?page='.$page.'&tri_par=idtrajet&ordre=asc'.$search_parameters);
      }

      if($tri_par == 'idtrajet') {
        if($ordre == 'asc') {
          $data['icone_idtrajet'] = 'fa-sort-asc';
        } else {
          $data['icone_idtrajet'] = 'fa-sort-desc';
        }
      } else {
        $data['icone_idtrajet'] = 'fa-sort';
      }

      // villeorigine
      if($tri_par == 'villeorigine' && $ordre == 'asc') {
        $data['href_villeorigine'] = admin_url('trajet?page='.$page.'&tri_par=villeorigine&ordre=desc'.$search_parameters);
      } else {
        $data['href_villeorigine'] = admin_url('trajet?page='.$page.'&tri_par=villeorigine&ordre=asc'.$search_parameters);
      }

      if($tri_par == 'villeorigine') {
        if($ordre == 'asc') {
          $data['icone_villeorigine'] = 'fa-sort-asc';
        } else {
          $data['icone_villeorigine'] = 'fa-sort-desc';
        }
      } else {
        $data['icone_villeorigine'] = 'fa-sort';
      }

      // villedestination
      if($tri_par == 'villedestination' && $ordre == 'asc') {
        $data['href_villedestination'] = admin_url('trajet?page='.$page.'&tri_par=villedestination&ordre=desc'.$search_parameters);
      } else {
        $data['href_villedestination'] = admin_url('trajet?page='.$page.'&tri_par=villedestination&ordre=asc'.$search_parameters);
      }

      if($tri_par == 'villedestination') {
        if($ordre == 'asc') {
          $data['icone_villedestination'] = 'fa-sort-asc';
        } else {
          $data['icone_villedestination'] = 'fa-sort-desc';
        }
      } else {
        $data['icone_villedestination'] = 'fa-sort';
      }

      // distance
      if($tri_par == 'distance' && $ordre == 'asc') {
        $data['href_distance'] = admin_url('trajet?page='.$page.'&tri_par=distance&ordre=desc'.$search_parameters);
      } else {
        $data['href_distance'] = admin_url('trajet?page='.$page.'&tri_par=distance&ordre=asc'.$search_parameters);
      }

      if($tri_par == 'distance') {
        if($ordre == 'asc') {
          $data['icone_distance'] = 'fa-sort-asc';
        } else {
          $data['icone_distance'] = 'fa-sort-desc';
        }
      } else {
        $data['icone_distance'] = 'fa-sort';
      }

      return $data;
    }

}
?>
