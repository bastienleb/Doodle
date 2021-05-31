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

class Admin extends CI_Controller {

    public function resultat(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');

        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data=array('titres' => $titres);


        $this->load->view('templates/header');
        $this->load->view('page_admin',$data);
        $this->load->view('templates/footer');
    }

    public function delete($titre){
        
        $this->load->model('Securite');
        $this->load->model('ModeleSondage');
        Securite::Connect();

        $titre=str_replace("%20"," ",$titre);

        if($this->ModeleSondage->sup_sondage($titre)){
            header("Location:../../home/jeux");
        }
    }



}

?>