<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class UtilisateurFo extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        $this->load->model('utilisateur_model');

        $this->load->library('form_validation');

    }

    public function index() {
      if(parent::utilisateur_connected()){
        redirect(site_url("routefo"));
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
        redirect(site_url('routefo'));
      }

      $this->load->view('fo/my_login');
    }

    public function connexion() {
      $identifiant = $this->input->post('identifiant');
      $mdp = $this->input->post('mdp');

      $utilisateur = $this->utilisateur_model->connexion($identifiant, $mdp);
      if($utilisateur == null){
        return false;
      }

      $this->session->set_userdata("idUtilisateur", $utilisateur->idutilisateur);

      return true;
    }

    public function deconnexion() {
      $this->session->sess_destroy();
      redirect(site_url());
    }

}
?>
