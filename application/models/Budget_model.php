<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Budget_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_budget() {
      return $this->db->get('budget')->result()[0]->budget;
    }

    public function update_budget($budget) {
      return $this->db->update('budget', ['budget' => $budget]);
    }

  }

?>
