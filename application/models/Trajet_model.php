<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Trajet_model extends Base_Model {

    const PAGINATION_NOMBRE = 3;

    public function __construct()
    {
      parent::__construct();
    }

    public function get_trajets() {
      return $this->db->get('trajet')->result();
    }

    public function get_page_trajets($page, $tri_par, $ordre, $search) {
      $first = ($page - 1) * self::PAGINATION_NOMBRE;
      $sql = 'select * from trajet ' . $this->get_where_clause($search)
              .$this->get_order_clause($tri_par, $ordre) . $this->get_pagination_clause($page);
      // echo $sql;
      return $this->db->query($sql)->result();
    }

    public function get_order_clause($tri_par, $ordre) {
      $sql = "order by %s %s ";
      $sql = sprintf($sql, $tri_par, $ordre);
      return $sql;
    }

    public function get_pagination_clause($page) {
      $first = ($page - 1) * self::PAGINATION_NOMBRE;
      $sql = "limit %d offset %d ";
      $sql = sprintf($sql, self::PAGINATION_NOMBRE, $first);
      return $sql;
    }

    public function get_nb_pages($search) {
      $nb_total = $this->db->query('select count(*) as count from trajet '.$this->get_where_clause($search))->result()[0]->count;
      return ceil($nb_total / self::PAGINATION_NOMBRE);
    }

    public function get_where_clause($search) {
      $sql = "where idtrajet::varchar like '%s%s%s' and lower(villeorigine) like lower('%s%s%s') and lower(villedestination) like lower('%s%s%s') ";
      $sql = sprintf($sql, '%', $search['idtrajet'], '%', '%', $search['villeorigine'], '%', '%', $search['villedestination'], '%');
      $distancemin = $search['distancemin'];
      $distancemax = $search['distancemax'];
      if($distancemin != "" && $distancemax == "") {
        $distancemax = $distancemin;
      } else if($distancemax != "" && $distancemin == "") {
        $distancemin = $distancemax;
      }

      if($distancemin != "" && $distancemax != ""){
        $sql2 = "and distance >= %d and distance <= %d ";
        $sql2 = sprintf($sql2, $distancemin, $distancemax);
        $sql .= $sql2;
      }

      return $sql;
    }

    public function insert_trajet($trajet) {
      return $this->db->insert('trajet', $trajet);
    }

    public function get_trajet($idtrajet) {
      return $this->db->get_where('trajet', ['idtrajet' => $idtrajet])->result()[0];
    }

    public function update_trajet($idtrajet, $trajet) {
      return $this->db->update('trajet', ['villeorigine' => $trajet['villeorigine'],
            'villedestination' => $trajet['villedestination'], 'distance' => $trajet['distance']], ['idtrajet' => $idtrajet]);
    }

    public function supprimer_trajet($idtrajet) {
      return $this->db->delete('trajet', ['idtrajet' => $idtrajet]);
    }

  }

?>
