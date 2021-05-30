<?php 
class Admin extends CI_Controller {

    public function resultat(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');

        Securite::Connect();


        $this->load->view('templates/header');
        $this->load->view('page_admin');
        $this->load->view('templates/footer');

    }



}

?>