<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Reparation_model extends Base_Model {

    const route_modifiable = 'modifiable';
    const route_validee = 'validee';

    public function __construct()
    {
      parent::__construct();
    }

    public function get_routes() {
      return $this->db->get('route')->result();
    }

    public function insert_reparation($reparation) {
      return $this->db->query('insert into reparation values(default, ?, ?, current_timestamp)', [$reparation['idportion'], $reparation['montant']]);
    }

    public function get_reparations() {
      return $this->db->query('select * from historique_reparation order by datereparation desc')->result();
    }

  }

?>
