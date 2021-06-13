<?php

/*
###########################################################################
#                                                                         #
#                                                                         #
#     #####        #####       #####      #####      #         ######     #
#     #    #      #     #     #     #     #    #     #         #          #
#     #     #    #       #   #       #    #     #    #         #          #
#     #     #    #       #   #       #    #     #    #         ####       #
#     #     #    #       #   #       #    #     #    #         #          #
#     #    #      #     #     #     #     #    #     #         #          #
#     #####        #####       #####      #####      ######    ######     #
#                                                                         #
#                                                                         #
#                Réalisé par Bastien LEBLET & Kévin METRI                 #
#                                                                         #
#                                                                         #
###########################################################################
*/
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
        return $this->db->where('titre', $titre)->delete('doodle_sondage');
    }

    public function update_sondage($data,$titre){
        $this->db->where('titre',$titre);
        return $this->db->update('doodle_sondage',$data);
    }
     
}
?>