<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Billet extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        $this->load->model("personne_model");
        $this->load->model("vol_model");
        $this->load->model("billet_model");
    }

    public function index() {
        $data['title'] = 'Achat de Billet';

        $data['contents'] = 'achat_billet';

        $data['personnes'] = $this->personne_model->get_personnes();
        $data['vols'] = $this->vol_model->get_prochains_vols();
        $data['typePassagers'] = $this->personne_model->get_typePassagers();

        $data['error'] = false;
        if($this->session->userdata('error') != null){
          $data['error'] = $this->session->userdata('error');
          $data['msg_error'] = $this->session->userdata('msg_error');
        }

        $this->load->view('fo/template', $data);
    }

    public function insert_billet(){
      $billet = $this->input->get();
      $vol_tarif_details = $this->billet_model->get_vols_tarifs_details($billet['idvol'], $billet['idtypepassager']);

      if($vol_tarif_details->nbbilletdispo <= 0){
        $session = array(
              'error' => true,
              'msg_error' => "Il n'y a plus de billet disponible pour ce vol"
          );
        $this->session->set_userdata($session);
        redirect('billet/');
        return;
      }

      $this->session->set_userdata('error', false);

      $billet['idoptiontarif'] = $vol_tarif_details->idoptiontarif;
      $montantNormal = $vol_tarif_details->prix;
      $montant = $montantNormal * $vol_tarif_details->pourcentageprix / 100;
      if($billet['isremboursable'] == 'false'){
        // $montant = $montant * (100 - $vol_tarif_details->remisenonremboursable) / 100;
        $montant = $montant - ($montantNormal * $vol_tarif_details->remisenonremboursable / 100);
      }
      if($billet['ismodifiable'] == 'false') {
        $montant = $montant - ($montantNormal * $vol_tarif_details->remisenonmodifiable / 100);
      }

      $billet['montant'] = $montant;
      unset($billet['idtypepassager']);

      $this->db->trans_begin();
      if($this->billet_model->insert_billet($billet)) {
        $this->db->trans_commit();
        redirect('vol/');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }

    }

}
?>
