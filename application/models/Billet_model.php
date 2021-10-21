<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Billet_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function insert_billet($billet) {
      return $this->db->insert('billet', $billet);
    }

    public function get_vols_tarifs_details($idvol, $idtypepassager) {
      return $this->db->get_where('vols_tarifs_details', ['idvol' => $idvol, 'idtypepassager' => $idtypepassager])->result()[0];
    }

  }

?>
