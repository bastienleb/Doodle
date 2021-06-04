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
        $this->load->model('ModeleResultat');

        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data =array('titres' => $titres);

        foreach($titres as $titre){
            $titre_hash= hash("ripemd160",$titre->titre);
            if($_GET['cle']==$titre_hash){
                $verif = $this->ModeleResultat->get_resultat($titre->titre); 
                $data_verif=array('verif' => $verif);
                $data=array_replace($data,$data_verif);
            }
        }



        $this->load->view('templates/header');
        $this->load->view('page_admin',$data);
        $this->load->view('templates/footer');
    }

    public function delete($titre){
        
        $this->load->model('Securite');
        $this->load->model('ModeleSondage');
        $this->load->model('ModeleResultat');
        
        Securite::Connect();
        
        $titre=str_replace("%20"," ",$titre);
        echo $titre;
        
        if($this->ModeleSondage->sup_sondage($titre) && $this->ModeleResultat->sup_reponse($titre)){
            header("Location:../../home/jeux");
        }
    }



}

?>