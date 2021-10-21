<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require ('Base_Controller.php');

class Vol extends Base_Controller  {
    public function __construct() {
        parent::__construct();

        $this->load->model("personne_model");
        $this->load->model("vol_model");
        $this->load->model("billet_model");
    }

    public function index() {
        $data['title'] = 'Les prochains vols';

        $data['contents'] = 'liste_vols';


        $this->load->view('fo/template', $data);
    }

    public function liste_passagers_previsionnels($idvol){
      $data['title'] = 'Passagers prévisionneles du vol';

      $data['contents'] = 'liste_passagers_previsionnels';

      $data['vol'] = $this->vol_model->get_vol_details($idvol);
      $data['passagers'] = $this->vol_model->get_passagers_previsionnels($idvol);

      $this->load->view('fo/template', $data);
    }

    public function valider_billet($idvol, $idbillet) {
      $this->db->trans_begin();
      if($this->vol_model->valider_billet($idbillet)) {
        $this->db->trans_commit();
        redirect('vol/liste_passagers_previsionnels/'.$idvol);
      } else {
        $this->db->trans_rollback();
        echo $this->db->error();
      }
    }

    public function liste_passagers_reels($idvol){
      $data['title'] = 'Passagers réels du vol';

      $data['contents'] = 'liste_passagers_reels';

      $data['vol'] = $this->vol_model->get_vol_details($idvol);
      $data['passagers'] = $this->vol_model->get_passagers_reels($idvol);

      $this->load->view('fo/template', $data);
    }

}
?>
