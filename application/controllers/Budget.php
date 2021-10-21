<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Budget extends Base_Controller  {

    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('budget_model');

        $this->load->library('form_validation');
    }


    public function get_config() {
      $config = array(
        array(
          'field' => 'budget',
          'label' => "Budget",
          'rules' => 'trim|required|numeric|greater_than[0]'
        )
      );
      return $config;
    }

    public function index() {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->add_budget();
      }

      $data['budget'] = $this->budget_model->get_budget();

      $data['title'] = "Budget de l'organisme";

      $data['contents'] = 'add_budget';

      $this->load->view('bo/template', $data);
    }

    public function add_budget() {
      $budget = $this->input->post('budget');

      $this->db->trans_begin();
      $budget_actuel = $this->budget_model->get_budget();
      $budget_actuel += $budget;
      if($this->budget_model->update_budget($budget_actuel)) {
        $this->db->trans_commit();
        redirect('budget');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
