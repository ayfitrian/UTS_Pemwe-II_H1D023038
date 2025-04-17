<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Mengambil statistik pemilihan
    public function get_vote_stats() {
        $this->db->select('candidate_id, COUNT(*) as votes');
        $this->db->group_by('candidate_id');
        $query = $this->db->get('votes'); // Misalnya tabelnya bernama 'votes'
        return $query->result();
    }
}
