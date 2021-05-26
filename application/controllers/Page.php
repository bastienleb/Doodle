<?php
class Page extends CI_Controller{
    
    public function index()
	{
        $this->load->model('Securite');
        Securite::Connect();
        
        $deco = filter_input(INPUT_POST,"deco",FILTER_DEFAULT);
        
        
        
        
        $this->load->view('templates/header');
        if($deco==1){
            Securite::Deconnect();
            header('Location:Connexion');
            //$this->load->controllers('Connexion');
        }
        else{
            header('Location:Page');
            
        }
        $this->load->view('templates/footer');
    }
}
?>
