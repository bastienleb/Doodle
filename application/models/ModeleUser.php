<?php
class ModeleUser extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function get_titre(){
        $this->db->select('*')->from('doodle_sondage');
        $query=$this->db->get();
        return $query->result();
    }

}
?>