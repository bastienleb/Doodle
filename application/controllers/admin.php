<?php 
class Admin extends CI_Controller {

    public function resultat(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');

        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data=array('titres' => $titres);


        $this->load->view('templates/header');
        $this->load->view('page_admin',$data);
        $this->load->view('templates/footer');

    }



}

?>