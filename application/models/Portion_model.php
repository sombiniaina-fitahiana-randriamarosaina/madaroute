<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Portion_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_portions($idroute) {
      return $this->db->query('select * from portion_etatportion where idroute=? order by pkDebut', $idroute)->result();
    }

    public function insert_portion($portion) {
      return $this->db->insert('portion', $portion);
    }

    public function get_portion($idportion) {
      return $this->db->get_where('portion', ['idportion' => $idportion])->result()[0];
    }

    public function update_portion($idportion, $portion) {
      return $this->db->update('portion', ['idroute' => $portion['idroute'], 'pkdebut' => $portion['pkdebut'],
            'pkfin' => $portion['pkfin'], 'idetatportion' => $portion['idetatportion']], ['idportion' => $idportion]);
    }

    public function reparer_portion($idportion) {
      return $this->db->update('portion', ['idetatportion' => 1], ['idportion' => $idportion]);
    }

    public function supprimer_portion($idportion) {
      return $this->db->delete('portion', ['idportion' => $idportion]);
    }

  }

?>
