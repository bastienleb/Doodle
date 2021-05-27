<?php

class Home extends CI_Controller{

    public function jeux()
    {
        $this->load->model('Securite');
        Securite::Connect();
        
        $deco = filter_input(INPUT_POST,"deco",FILTER_DEFAULT);
        
        
        
        
        $this->load->view('templates/header');
        if($deco==1){
            Securite::Deconnect();
            header('Location:../connexion/');
            //$this->load->controllers('Connexion');
        }
        else{
            $this->load->view('page');
            
        }
        $this->load->view('templates/footer');
    }
}

?>