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
class Participant extends CI_Controller {

    public function choix(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');
        $this->load->model('ModeleResultat');

        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data=array('titres' => $titres);
        
        //echo $_POST['jour']." ".$_POST['heure']."<br>";

        $login =$_SESSION['login'];
        $jour = date("Y-d-m", strtotime($this->input->post('jour')));
        $heure = $this->input->post('heure');
        $titre = $this->input->post('titre');

        $data_sondage=array(
            'login'=>$login,
            'jour'=> $jour,
            'heure'=>$heure,
            'titre_sondage'=>$titre
        );
        
        
        //$creneaux =$this->ModeleResultat->addresultat($data_sondage);
        //$add_data=array('creneaux' => $creneaux);

        //$data=array_replace($data,$add_data);

        


        $this->load->view('templates/header');
        $this->load->view('participant',$data);
        $this->load->view('templates/footer');
    } 
}