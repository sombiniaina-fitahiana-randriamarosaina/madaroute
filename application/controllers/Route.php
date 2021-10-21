<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Route extends Base_Controller  {

    const route_modifiable = 'modifiable';
    const route_validee = 'validee';

    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('route_model');

        $this->load->library('form_validation');
    }

    public function index() {
      $data['title'] = 'Liste des Routes';

      $data['contents'] = 'liste_routes';

      $data['routes'] = $this->route_model->get_routes();

      $this->load->view('bo/template', $data);
    }

    public function valider_route($idroute) {
      $route = $this->route_model->get_route($idroute);
      $distance_portions = 0;
      $route_portions_distance = $this->route_model->get_route_portions_distance($idroute)->distance;
      if($route_portions_distance != null) {
        $distance_portions = $route_portions_distance;
      }
      if($route->distance != $distance_portions) {
        $this->session->set_userdata('message', 'La somme des distances des portions est différent de la distance de sa route'. $route->numroute);
        redirect('route');
        return;
      }

      $portions = $this->route_model->get_route_portions_details($idroute);
      if($portions[0]->pkdebut != 0) {
        $this->session->set_userdata('message', 'La première portion doit commencé par le pk 0');
        redirect('route');
        return;
      }
      for($i=1; $i<count($portions); $i++) {
        if($portions[$i]->pkdebut != $portions[$i-1]->pkfin){
          $this->session->set_userdata('message', "Les pk des portions de la route " . $route->numroute . " ne s'enchaine pas");
          redirect("route");
          return;
        }
      }

      $this->route_model->valider_route($idroute);
      $this->session->set_userdata('message', "La route". $route->numroute ." est maintenant validée");
      redirect("route");

    }

    public function get_config() {
      $config = array(
        array(
          'field' => 'numroute',
          'label' => "Numero de route",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'villedepart',
          'label' => "ville de départ",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'villearrivee',
          'label' => "ville d'arrivée",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'distance',
          'label' => "distance",
          'rules' => 'trim|required|numeric|greater_than[0]'
        )
      );
      return $config;
    }

    public function nouveau() {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->insert_route();
      }

      $data['title'] = 'Nouvelle Route';

      $data['contents'] = 'nouveau_route';

      $this->load->view('bo/template', $data);
    }

    public function insert_route() {
      $route = $this->input->post();

      $this->db->trans_begin();
      if($this->route_model->insert_route($route)) {
        $this->db->trans_commit();
        redirect('route');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idroute) {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->modifier_route($idroute);
      }

      $data['title'] = 'Modification Route';

      $data['contents'] = 'modification_route';

      $data['route'] = $this->route_model->get_route($idroute);

      $this->load->view('bo/template', $data);
    }

    public function modifier_route($idroute) {
      $route = $this->input->post();

      $this->db->trans_begin();
      if($this->route_model->update_route($idroute, $route)) {
        $this->db->trans_commit();
        redirect('route');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_route($idroute) {
      $this->db->trans_begin();
      if($this->route_model->supprimer_route($idroute)) {
        $this->db->trans_commit();
        redirect('route');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
