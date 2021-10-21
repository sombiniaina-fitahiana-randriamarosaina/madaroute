<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Vol_admin_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_vols() {
      return $this->db->get('vols_details')->result();
    }

    public function get_avions() {
      return $this->db->get('avion')->result();
    }

    public function insert_vol($vol) {
      return $this->db->insert('vol', $vol);
    }

    public function get_vol($idvol) {
      return $this->db->get_where('vol', ['idvol' => $idvol])->result()[0];
    }

    public function update_vol($idvol, $vol) {
      return $this->db->update('vol', ['idavion' => $vol['idavion'],
            'idtrajet' => $vol['idtrajet'], 'dateheurevol' => $vol['dateheurevol']], ['idvol' => $idvol]);
    }

    public function supprimer_vol($idvol) {
      return $this->db->delete('vol', ['idvol' => $idvol]);
    }

  }

?>
