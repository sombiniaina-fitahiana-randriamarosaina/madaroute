<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class EtatPortion extends Base_Controller  {

    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('etatPortion_model');

        $this->load->library('form_validation');
    }

    public function index() {
      $data['title'] = 'Liste des Etats de portion';

      $data['contents'] = 'liste_etatPortions';

      $data['etatPortions'] = $this->etatPortion_model->get_etatPortions();

      $this->load->view('bo/template', $data);
    }

    public function get_config() {
      $config = array(
        array(
          'field' => 'etat',
          'label' => "Etat",
          'rules' => 'trim|required|is_natural_no_zero'
        ),
        array(
          'field' => 'libelleetat',
          'label' => "Libellé d'état",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'coutreparation',
          'label' => "Coût de réparation",
          'rules' => 'trim|required|numeric|greater_than[0]'
        ),
        array(
          'field' => 'dureereparation',
          'label' => "Durée de réparation",
          'rules' => 'trim|required|is_natural'
        ),
        array(
          'field' => 'coeffdeg',
          'label' => "Coefficient de dégradation",
          'rules' => 'trim|required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'
        )
      );
      return $config;
    }

    public function nouveau() {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->insert_etatPortion();
      }

      $data['title'] = 'Nouvel Etat de portion';

      $data['contents'] = 'nouveau_etatPortion';

      $this->load->view('bo/template', $data);
    }

    public function insert_etatPortion() {
      $etatPortion = $this->input->post();

      $this->db->trans_begin();
      if($this->etatPortion_model->insert_etatPortion($etatPortion)) {
        $this->db->trans_commit();
        redirect('etatPortion');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idetatportion) {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->modifier_etatPortion($idetatportion);
      }

      $data['title'] = "Modification d'Etat de portion";

      $data['contents'] = 'modification_etatPortion';

      $data['etatPortion'] = $this->etatPortion_model->get_etatPortion($idetatportion);

      $this->load->view('bo/template', $data);
    }

    public function modifier_etatPortion($idetatportion) {
      $etatPortion = $this->input->post();

      $this->db->trans_begin();
      if($this->etatPortion_model->update_etatPortion($idetatportion, $etatPortion)) {
        $this->db->trans_commit();
        redirect('etatPortion');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_etatPortion($idetatportion) {
      $this->db->trans_begin();
      if($this->etatPortion_model->supprimer_etatPortion($idetatportion)) {
        $this->db->trans_commit();
        redirect('etatPortion');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
