<?php 
class Connexion extends CI_Controller {

    public function index()
	{
        $this->load->view('templates/header');
        $this->load->view('connexion');
        $this->load->view('templates/footer');
    }
     
}

?>


