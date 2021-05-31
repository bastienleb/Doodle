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

class Home extends CI_Controller{

    public function jeux()
    {   
        $this->load->model('Securite');
        $this->load->library('form_validation');
        $this->load->model('ModeleSondage');
        $this->load->library('table');
        Securite::Connect();
        
        $this->form_validation->set_rules('titre', 'titre', 'required|is_unique[doodle_sondage.titre]');
		$this->form_validation->set_rules('lieu', 'lieu', 'required|trim');
        $this->form_validation->set_rules('descriptif', 'descriptif', 'required|trim');
		$this->form_validation->set_rules('date_debut', 'date_debut', 'required|trim');
        $this->form_validation->set_rules('date_fin', 'date_fin', 'required|trim');
		$this->form_validation->set_rules('heure_debut', 'heure_debut', 'required|trim');
        $this->form_validation->set_rules('heure_fin', 'heure_fin', 'required|trim');
        $this->form_validation->set_rules('login', 'login', 'required|trim');

        $this->form_validation->set_message('is_unique', '{field} est déjà présent dans la base.');
        
        if ($this->form_validation->run() === FALSE){
        }
        else{
            $titre = $this->input->post('titre');
            $lieu = $this->input->post('lieu');
            $descriptif = $this->input->post('descriptif');
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            $heure_debut = $this->input->post('heure_debut');
            $heure_fin = $this->input->post('heure_fin');
            $login = $this->input->post('login');

            $data=array(
                'titre'=>$titre,
                'lieu'=> $lieu,
                'descriptif'=>$descriptif,
                'date_debut'=>$date_debut,
                'date_fin'=>$date_fin,
                'heure_debut'=>$heure_debut,
                'heure_fin'=>$heure_fin,
                'createur'=>$login
            );            
            $this->ModeleSondage->addSondage($data);
            echo"<script type='text/javascript'> alert('Sondage créer'); </script>";
        }
            
        $sondages = $this->ModeleSondage->get_sondage($_SESSION['login']);
        $data_sondage=array('sondages' => $sondages);
        
        $this->load->view('templates/header');
        $this->load->view('page',$data_sondage);
        $this->load->view('templates/footer');
    }
}

?>