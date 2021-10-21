<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Portion extends Base_Controller  {

    const route_modifiable = 'modifiable';
    const route_validee = 'validee';

    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('portion_model');
        $this->load->model('route_model');
        $this->load->model('etatPortion_model');

        $this->load->library('form_validation');
    }

    public function liste($idroute) {
      $data['title'] = 'Liste des Portions de la route';

      $data['contents'] = 'liste_portions';

      $data['portions'] = $this->portion_model->get_portions($idroute);
      $data['route'] = $this->route_model->get_route($idroute);

      $this->load->view('bo/template', $data);
    }

    public function get_config() {
      $config = array(
        array(
          'field' => 'pkdebut',
          'label' => "Pk début",
          'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
        ),
        array(
          'field' => 'pkfin',
          'label' => "Pk fin",
          'rules' => 'trim|required|numeric|greater_than_equal_to[0]'
        )
      );
      return $config;
    }

    public function nouveau($idroute) {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->insert_portion($idroute);
      }

      $data['route'] = $this->route_model->get_route($idroute);

      $data['etatPortions'] = $this->etatPortion_model->get_etatPortions();

      $data['title'] = 'Nouvelle Portion de la route ' . $data['route']->numroute;

      $data['contents'] = 'nouveau_portion';

      $this->load->view('bo/template', $data);
    }

    public function insert_portion($idroute) {
      $portion = $this->input->post();
      $portion['idroute'] = $idroute;

      $this->db->trans_begin();
      if($this->portion_model->insert_portion($portion)) {
        $this->db->trans_commit();
        redirect('portion/liste/'.$idroute);
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idportion) {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->modifier_portion($idportion);
      }

      $data['title'] = 'Modification Portion';

      $data['contents'] = 'modification_portion';

      $data['portion'] = $this->portion_model->get_portion($idportion);
      $data['etatPortions'] = $this->etatPortion_model->get_etatPortions();
      $data['route'] = $this->route_model->get_route($data['portion']->idroute);

      $this->load->view('bo/template', $data);
    }

    public function modifier_portion($idportion) {
      $portion = $this->input->post();

      $this->db->trans_begin();
      if($this->portion_model->update_portion($idportion, $portion)) {
        $this->db->trans_commit();
        redirect('portion/liste/'.$portion['idroute']);
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_portion($idportion) {
      $this->db->trans_begin();
      $portion = $this->portion_model->get_portion($idportion);
      if($this->portion_model->supprimer_portion($idportion)) {
        $this->db->trans_commit();
        redirect('portion/liste/'.$portion->idroute);
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
