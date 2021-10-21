<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Utilisateur_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_utilisateurs() {
      return $this->db->get('utilisateur')->result();
    }

    public function insert_utilisateur($utilisateur) {
      $sql = "insert into utilisateur values(default, ?, ?, md5(?))";
      return $this->db->query($sql, [$utilisateur['nom'], $utilisateur['mail'], $utilisateur['mdp']]);
    }

    public function get_utilisateur($idutilisateur) {
      return $this->db->get_where('utilisateur', ['idutilisateur' => $idutilisateur])->result()[0];
    }

    public function update_utilisateur($idutilisateur, $utilisateur) {
      $sql = "update utilisateur set nom=?, mail=?, mdp=md5(?) where idutilisateur=?";
      return $this->db->query($sql, [$utilisateur['nom'], $utilisateur['mail'], $utilisateur['mdp'], $idutilisateur]);
    }

    public function supprimer_utilisateur($idutilisateur) {
      return $this->db->delete('utilisateur', ['idutilisateur' => $idutilisateur]);
    }

    public function connexion($identifiant, $mdp) {
      $utilisateur = $this->db->query('SELECT * FROM utilisateur WHERE mail = ? AND mdp = md5(?)', [$identifiant, $mdp])->result();
      if($utilisateur == null){
        return null;
      }
      return $utilisateur[0];
    }

  }

?>
