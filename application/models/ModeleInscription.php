<?php
class ModeleInscription extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function addUser($data){
        return $this->db->insert('doodle_user', $data);
    }

    public  function RecupLog($user) {
        $this->db-> select('*')->from('doodle_user');
        $this->db->where('login',$user['login']);
        $query=$this->db->get();
        return $query->result();
    } 
     
}
?>