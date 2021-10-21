<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Route_model extends Base_Model {

    const route_modifiable = 'modifiable';
    const route_validee = 'validee';

    public function __construct()
    {
      parent::__construct();
    }

    public function get_routes() {
      return $this->db->get('route')->result();
    }

    public function insert_route($route) {
      return $this->db->insert('route', $route);
    }

    public function get_route($idroute) {
      return $this->db->get_where('route', ['idroute' => $idroute])->result()[0];
    }

    public function get_route_fiche($idroute) {
      return $this->db->get_where('route_fiche', ['idroute' => $idroute])->result()[0];
    }

    public function update_route($idroute, $route) {
      return $this->db->update('route', ['numroute' => $route['numroute'], 'villedepart' => $route['villedepart'],
            'villearrivee' => $route['villearrivee'], 'distance' => $route['distance']], ['idroute' => $idroute]);
    }

    public function supprimer_route($idroute) {
      return $this->db->delete('route', ['idroute' => $idroute]);
    }

    public function get_all_routes_etatGlobal() {
      return $this->db->get_where('route_etatglobal_view', ['etat' => 'validee'])->result();
    }

    public function get_routes_etatGlobal($search, $ordre) {
      $sql = "select * from route_etatglobal_view where etat='validee' and villedepart ilike '%s%s%s' and villearrivee ilike '%s%s%s' order by numroute %s";
      $sql = sprintf($sql, '%', $search['villedepart'], '%', '%', $search['villearrivee'], '%', $ordre);
      return $this->db->query($sql)->result();
    }

    public function get_route_portions_details($idroute) {
      return $this->db->query('select * from route_portions_details where idroute = ? order by pkdebut', $idroute)->result();
    }

    public function get_route_portion_details($idportion) {
      return $this->db->get_where('route_portions_details', ['idportion' => $idportion])->result()[0];
    }

    public function get_route_entretien_total($idroute) {
      return $this->db->get_where('route_entretien_total', ['idroute' => $idroute])->result()[0];
    }

    public function get_route_portions_distance($idroute) {
      $portions = $this->db->get_where('route_distance', ['idroute' => $idroute])->result();
      if($portions != null){
        return $portions[0];
      }
      return null;
    }

    public function valider_route($idroute) {
      return $this->db->update('route', ['etat' => self::route_validee], ['idroute' => $idroute]);
    }

  }

?>
