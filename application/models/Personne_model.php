<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Personne_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_personnes() {
      $personnes = $this->db->get('personne')->result();
      return $personnes;
    }

    public function get_typePassagers() {
      $typePassagers = $this->db->get('typepassager')->result();
      return $typePassagers;
    }

    // public function get_derniers_articles() {
    //   $articles = $this->db->query('SELECT * FROM article_complet ORDER BY dateArticle DESC LIMIT ?', 6)->result();
    //   return $articles;
    // }


  }

?>
