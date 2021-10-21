<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Vol_admin extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        if(!parent::admin_connected()) {
          redirect(admin_url());
          return;
        }

        $this->load->model('vol_admin_model');
        $this->load->model('trajet_model');
    }

    public function index() {
      $data['title'] = 'Liste des Vols';

      $data['contents'] = 'liste_vols';

      $data['vols'] = $this->vol_admin_model->get_vols();

      $this->load->view('bo/template', $data);
    }

    public function nouveau() {
      $data['title'] = 'Nouveau Vol';

      $data['contents'] = 'nouveau_vol';
      $data['avions'] = $this->vol_admin_model->get_avions();
      $data['trajets'] = $this->trajet_model->get_trajets();

      $this->load->view('bo/template', $data);
    }

    public function insert_vol() {
      $vol['idavion'] = $this->input->post('idavion');
      $vol['idtrajet'] = $this->input->post('idtrajet');
      $vol['dateheurevol'] = $this->input->post('datevol').' '.$this->input->post('heurevol');

      $this->db->trans_begin();
      if($this->vol_admin_model->insert_vol($vol)) {
        $this->db->trans_commit();
        redirect('vol_admin');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function modification($idvol) {
      $data['title'] = 'Modification Vol';

      $data['contents'] = 'modification_vol';

      $data['vol'] = $this->vol_admin_model->get_vol($idvol);
      $data['avions'] = $this->vol_admin_model->get_avions();
      $data['trajets'] = $this->trajet_model->get_trajets();

      $this->load->view('bo/template', $data);
    }

    public function modifier_vol($idvol) {
      $vol['idavion'] = $this->input->post('idavion');
      $vol['idtrajet'] = $this->input->post('idtrajet');
      $vol['dateheurevol'] = $this->input->post('datevol').' '.$this->input->post('heurevol');

      $this->db->trans_begin();
      if($this->vol_admin_model->update_vol($idvol, $vol)) {
        $this->db->trans_commit();
        redirect('vol_admin');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function supprimer_vol($idvol) {
      $this->db->trans_begin();
      if($this->vol_admin_model->supprimer_vol($idvol)) {
        $this->db->trans_commit();
        redirect('vol_admin');
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

}
?>
