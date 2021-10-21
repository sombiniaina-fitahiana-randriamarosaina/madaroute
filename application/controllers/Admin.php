<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Admin extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        $this->load->model('admin_model');

        $this->load->library('form_validation');

    }

    public function index() {
      if(parent::admin_connected()){
        redirect(admin_url("route"));
      }
      $config = array(
        array(
          'field' => 'identifiant',
          'label' => 'Email',
          'rules' => 'trim|required|valid_email'
        ),
        array(
          'field' => 'mdp',
          'label' => 'Mot de passe',
          'rules' => 'trim|required|callback_connexion',
          'errors' => array(
                  'connexion' => 'Echec connexion. Identifiant ou mot de passe incorrect'
          )
        )
      );

      $this->form_validation->set_rules($config);

      if($this->form_validation->run()){
        redirect(admin_url('route'));
      }

      $this->load->view('bo/my_login');
    }

    public function connexion() {
      $identifiant = $this->input->post('identifiant');
      $mdp = $this->input->post('mdp');

      $admin = $this->admin_model->connexion($identifiant, $mdp);

      if($admin == null){
        return false;
      }
      $this->session->set_userdata("idAdmin", $admin->idadmin);

      return true;
    }

    public function deconnexion() {
      $this->session->sess_destroy();
      redirect(admin_url());
    }

    // public function index() {
    //   $data = array();
    //   $data['error'] = false;
    //
    //   if($this->session->userdata('error') !== null && $this->session->userdata('error') == true){
    //     $data['error'] = true;
    //     $data['msg_error'] = $this->session->userdata('msg_error');
    //   }
    //
    //   $this->load->view('bo/my_login', $data);
    // }

    // public function connexion() {
    //   $identifiant = $this->input->post('identifiant');
    //   $mdp = $this->input->post('mdp');
    //
    //   $admin = $this->admin_model->connexion($identifiant, $mdp);
    //   if($admin == null){
    //     $userdata = array(
    //       "error" => true,
    //       "msg_error" => "Echec connexion. Identifiant ou mot de passe incorrect"
    //     );
    //     $this->session->set_userdata($userdata);
    //     redirect(admin_url());
    //   }
    //   else{
    //     $this->session->set_userdata("idAdmin", $admin->idadmin);
    //     $this->session->set_userdata("error", false);
    //     redirect(admin_url('trajet'));
    //   }
    // }

}
?>
