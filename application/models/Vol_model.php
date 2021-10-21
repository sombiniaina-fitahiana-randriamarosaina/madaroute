<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Vol_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_prochains_vols() {
      $vols = $this->db->query('SELECT * FROM vol WHERE dateHeureVol > current_timestamp')->result();
      return $vols;
    }

    public function get_prochains_vols_details() {
      return $this->db->query('SELECT * FROM vols_details WHERE dateHeureVol > current_timestamp')->result();
    }

    public function get_vol_details($idvol) {
      return $this->db->get_where('vols_details', ['idvol' => $idvol])->result()[0];
    }

    public function get_passagers_previsionnels($idvol) {
      return $this->db->get_where('passagers_vol', ['idvol' => $idvol])->result();
    }

    public function valider_billet($idbillet) {
      return $this->db->update('billet', ['ispresent' => true], ['idbillet' => $idbillet]);
    }

    public function get_passagers_reels($idvol) {
      return $this->db->get_where('passagers_vol', ['idvol' => $idvol, 'ispresent' => true])->result();
    }

  }

?>
