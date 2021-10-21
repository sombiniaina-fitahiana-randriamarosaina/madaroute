<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Admin_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function connexion($identifiant, $mdp) {
      $admin = $this->db->query('SELECT * FROM admin WHERE mail = ? AND mdp = md5(?)', [$identifiant, $mdp])->result();
      if($admin == null){
        return null;
      }
      return $admin[0];
    }

  }

?>
