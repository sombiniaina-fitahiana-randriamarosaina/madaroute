<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class EtatPortion_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_etatPortions() {
      return $this->db->get('etatportion')->result();
    }

    public function insert_etatPortion($etatPortion) {
      return $this->db->insert('etatportion', $etatPortion);
    }

    public function get_etatPortion($idetatportion) {
      return $this->db->get_where('etatportion', ['idetatportion' => $idetatportion])->result()[0];
    }

    public function update_etatPortion($idetatportion, $etatportion) {
      return $this->db->update('etatportion', ['etat' => $etatportion['etat'], 'libelleetat' => $etatportion['libelleetat'],
            'coutreparation' => $etatportion['coutreparation'], 'dureereparation' => $etatportion['dureereparation'],
            'coeffdeg' => $etatportion['coeffdeg']], ['idetatportion' => $idetatportion]);
    }

    public function supprimer_etatPortion($idetatportion) {
      return $this->db->delete('etatportion', ['idetatportion' => $idetatportion]);
    }

  }

?>
