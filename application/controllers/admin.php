<?php 
class Admin extends CI_Controller {

    public function participant(){
        $this->load->model('ModeleUser');


        $this->load->view('page_admin');
        $this->load->view('templates/header');
        $this->load->view('templates/footer');

    }



}

?>