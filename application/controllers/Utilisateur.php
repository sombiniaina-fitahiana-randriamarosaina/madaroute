<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Utilisateur extends Base_Controller  {

    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('utilisateur_model');

        $this->load->library('form_validation');
    }

    public function index() {
      $data['title'] = 'Liste des Utilisateurs';

      $data['contents'] = 'liste_utilisateurs';

      $data['utilisateurs'] = $this->utilisateur_model->get_utilisateurs();

      $this->load->view('bo/template', $data);
    }

    public function get_config() {
      $config = array(
        array(
          'field' => 'nom',
          'label' => "Nom",
          'rules' => 'trim|required|alpha_numeric_spaces'
        ),
        array(
          'field' => 'mail',
          'label' => "Email",
          'rules' => 'trim|required|valid_email'
        ),
        array(
          'field' => 'mdp',
          'label' => "Mot de passe",
          'rules' => 'trim|required|alpha_numeric_spaces'
        )
      );
      return $config;
    }

    public function nouveau() {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->insert_utilisateur();
      }

      $data['title'] = 'Nouvel Utilisateur';

      $data['contents'] = 'nouveau_utilisateur';

      $this->load->view('bo/template', $data);
    }

    public function insert_utilisateur() {
      $utilisateur = $this->input->post();

      $this->db->trans_begin();
      if($this->utilisateur_model->insert_utilisateur($utilisateur)) {
        $this->db->trans_commit();
        redirect('utilisateur');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idutilisateur) {
      $this->form_validation->set_rules($this->get_config());

      if($this->form_validation->run()) {
        $this->modifier_utilisateur($idutilisateur);
      }

      $data['title'] = "Modification d'Utilisateur";

      $data['contents'] = 'modification_utilisateur';

      $data['utilisateur'] = $this->utilisateur_model->get_utilisateur($idutilisateur);

      $this->load->view('bo/template', $data);
    }

    public function modifier_utilisateur($idutilisateur) {
      $utilisateur = $this->input->post();

      $this->db->trans_begin();
      if($this->utilisateur_model->update_utilisateur($idutilisateur, $utilisateur)) {
        $this->db->trans_commit();
        redirect('utilisateur');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_utilisateur($idutilisateur) {
      $this->db->trans_begin();
      if($this->utilisateur_model->supprimer_utilisateur($idutilisateur)) {
        $this->db->trans_commit();
        redirect('utilisateur');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
