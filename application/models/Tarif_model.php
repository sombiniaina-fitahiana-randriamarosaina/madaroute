<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Tarif_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_tarifs() {
      return $this->db->get('tarifs_details')->result();
    }

    public function insert_tarif($tarif) {
      return $this->db->insert('tarif', $tarif);
    }

    public function insert_optionTarif($optiontarif){
      return $this->db->insert('optiontarif', $optiontarif);
    }

    public function get_tarif($idtarif) {
      return $this->db->get_where('tarif', ['idtarif' => $idtarif])->result()[0];
    }

    public function get_optionTarifs($idtarif) {
      return $this->db->get_where('optiontarif_details', ['idtarif' => $idtarif])->result();
    }

    public function update_tarif($idtarif, $tarif) {
      return $this->db->update('tarif', ['idtrajet' => $tarif['idtrajet'],
            'prix' => $tarif['prix'], 'remisenonremboursable' => $tarif['remisenonremboursable'],
            'remisenonmodifiable' => $tarif['remisenonmodifiable']], ['idtarif' => $idtarif]);
    }

    public function update_optionTarif($idoptiontarif, $optiontarif) {
      return $this->db->update('optiontarif', ['pourcentageprix' => $optiontarif['pourcentageprix']], ['idoptiontarif' => $idoptiontarif]);
    }

    public function supprimer_tarif($idtarif) {
      return $this->db->delete('tarif', ['idtarif' => $idtarif]);
    }

    public function supprimer_optionTarif($idtarif) {
      return $this->db->delete('optiontarif', ['idtarif' => $idtarif]);
    }

  }

?>
