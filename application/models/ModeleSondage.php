<?php
class ModeleSondage extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function addSondage($data){
        return $this->db->insert('doodle_sondage', $data);
    }

    public function get_sondage($login){
        $this->db->select('*')->from('doodle_sondage')->where('createur',$login);
        $query=$this->db->get();
        return $query->result();
    }

    public function sup_sondage($titre){
        echo "supprimer avec pour titre $titre";
        return $this->db->where('titre', $titre)->delete('doodle_sondage');
    }
     
}
?>