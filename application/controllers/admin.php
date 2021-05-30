<?php 
class Admin extends CI_Controller {

    public function resultat(){
        $this->load->model('ModeleUser');


        $this->load->view('templates/header');
        $this->load->view('page_admin');
        $this->load->view('templates/footer');

    }



}

?>