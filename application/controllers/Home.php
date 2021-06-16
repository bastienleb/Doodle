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
            $interdiction1 = '<';
            $interdiction2 = '>';
            $interdiction3 = '/';

            if($date_debut > $date_fin){
                ?>
                    <script type="text/javascript">
                        alert("le jour de debut de peut pas etre plus lointain que le jour de fin");
                    </script>

                <?php
            }
            else if ($heure_debut > $heure_fin){
                ?>
                    <script type="text/javascript">
                        alert("l'heure de debut de peut pas etre plus lointain que l'heure de fin");
                    </script>

                <?php
            }
            else{

                $test1 = stripos($titre, $interdiction1);
                $test2 = stripos($titre, $interdiction2);
                $test3 = stripos($titre, $interdiction3);
                $test4 = stripos($lieu, $interdiction1);
                $test5 = stripos($lieu, $interdiction2);
                $test6 = stripos($lieu, $interdiction3);
                $test7 = stripos($descriptif, $interdiction1);
                $test8 = stripos($descriptif, $interdiction2);
                $test9 = stripos($descriptif, $interdiction3);

                if($test1 == true || $test2 == true || $test3 == true|| $test4 == true || $test5 == true ||
                $test6 == true || $test7 == true || $test8 == true|| $test9 == true){
                    echo "<div class='error'> une ou plusieurs valeurs contient des caracteres interdits !</div>";
                }
                else{
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
                    if($this->ModeleSondage->addSondage($data)){
                        header("Location:../admin/resultat?cle=".hash('ripemd160',$titre));
                    }
                }
            }
        }
            
        $sondages = $this->ModeleSondage->get_sondage($_SESSION['login']);
        $data_sondage=array('sondages' => $sondages);
        
        $this->load->view('templates/header');
        $this->load->view('crea_sondage',$data_sondage);
        $this->load->view('templates/footer');
    }
    
}

?>