<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Tarif extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('tarif_model');
        $this->load->model('personne_model');
        $this->load->model('trajet_model');
    }

    public function index() {
      $data['title'] = 'Liste des Tarifs';

      $data['contents'] = 'liste_tarifs';

      $data['tarifs'] = $this->tarif_model->get_tarifs();

      $this->load->view('bo/template', $data);
    }

    public function nouveau() {
      $data['title'] = 'Nouveau Tarif';

      $data['contents'] = 'nouveau_tarif';

      $data['trajets'] = $this->trajet_model->get_trajets();
      $data['typePassagers'] = $this->personne_model->get_typePassagers();

      $this->load->view('bo/template', $data);
    }

    public function insert_tarif() {
      $tarif['idtrajet'] = $this->input->post('idtrajet');
      $tarif['prix'] = $this->input->post('prix');
      $tarif['remisenonremboursable'] = $this->input->post('remisenonremboursable');
      $tarif['remisenonmodifiable'] = $this->input->post('remisenonmodifiable');

      $this->db->trans_begin();
      if($this->tarif_model->insert_tarif($tarif)) {
        $idTarif = $this->db->insert_id();
        $typePassagers = $this->personne_model->get_typePassagers();
        foreach($typePassagers as $typePassager) {
          if(isset($_POST[$typePassager->idtypepassager])) {
            $optiontarif['idtarif'] = $idTarif;
            $optiontarif['idtypepassager'] = $typePassager->idtypepassager;
            $optiontarif['pourcentageprix'] = $this->input->post($typePassager->idtypepassager);

            $this->tarif_model->insert_optionTarif($optiontarif);
          }
        }

        $this->db->trans_commit();
        redirect('tarif');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idtarif) {
      $data['title'] = 'Modification Tarif';

      $data['contents'] = 'modification_tarif';

      $data['tarif'] = $this->tarif_model->get_tarif($idtarif);
      $data['trajets'] = $this->trajet_model->get_trajets();
      $data['optionTarifs'] = $this->tarif_model->get_optionTarifs($idtarif);

      $this->load->view('bo/template', $data);
    }

    public function modifier_tarif($idtarif) {
      $tarif['idtrajet'] = $this->input->post('idtrajet');
      $tarif['prix'] = $this->input->post('prix');
      $tarif['remisenonremboursable'] = $this->input->post('remisenonremboursable');
      $tarif['remisenonmodifiable'] = $this->input->post('remisenonmodifiable');

      $this->db->trans_begin();
      if($this->tarif_model->update_tarif($idtarif, $tarif)) {
        $typePassagers = $this->personne_model->get_typePassagers();
        foreach($typePassagers as $typePassager) {
          if(isset($_POST[$typePassager->idtypepassager])) {
            $optiontarif['pourcentageprix'] = $this->input->post($typePassager->idtypepassager);

            $this->tarif_model->update_optionTarif($idtarif, $optiontarif);
          }
        }

        $this->db->trans_commit();
        redirect('tarif');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_tarif($idtarif) {
      $this->db->trans_begin();
      if($this->tarif_model->supprimer_optionTarif($idtarif) && $this->tarif_model->supprimer_tarif($idtarif)) {
        $this->db->trans_commit();
        redirect('tarif');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
