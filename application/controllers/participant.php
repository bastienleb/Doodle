<?php 
class Participant extends CI_Controller {

    public function choix(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');

        
        Securite::Connect();


        $this->load->view('templates/header');
        $this->load->view('participant');
        $this->load->view('templates/footer');
    } 
}