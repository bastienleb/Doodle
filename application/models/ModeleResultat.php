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

class ModeleResultat extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function addresultat($data){
        return $this->db->insert('doodle_repondu', $data);
    }
    
/*
    public function get_resultat($login){
        $this->db->select('*')->from('doodle_repondu')->where('createur',$login);
        $query=$this->db->get();
        return $query->result();
    }
 */    
}
?>