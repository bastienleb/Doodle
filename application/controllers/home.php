<?php

class Home extends CI_Controller{

    public function jeux()
    {   
        $this->load->model('Securite');
        $this->load->library('form_validation');
        $this->load->model('ModeleSondage');
        Securite::Connect();
        
        $this->form_validation->set_rules('titre', 'titre', 'required|is_unique[doodle_sondage.titre]');
		$this->form_validation->set_rules('lieu', 'lieu', 'required|trim');
        $this->form_validation->set_rules('descriptif', 'descriptif', 'required|trim');
		$this->form_validation->set_rules('date', 'date', 'required|trim');
		$this->form_validation->set_rules('heure_debut', 'heure_debut', 'required|trim');
        $this->form_validation->set_rules('heure_fin', 'heure_fin', 'required|trim');
        $this->form_validation->set_rules('login', 'login', 'required|trim');

        $this->form_validation->set_message('is_unique', '{field} est déjà présent dans la base.');
        
        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
			$this->load->view('page');
			$this->load->view('templates/footer');
        }
        else{
            $titre = $this->input->post('titre');
            $lieu = $this->input->post('lieu');
            $descriptif = $this->input->post('descriptif');
            $date = $this->input->post('date');
            $heure_debut = $this->input->post('heure_debut');
            $heure_fin = $this->input->post('heure_fin');
            $login = $this->input->post('login');

            $data=array(
                'titre'=>$titre,
                'lieu'=> $lieu,
                'descriptif'=>$descriptif,
                'date'=>$date,
                'heure_debut'=>$heure_debut,
                'heure_fin'=>$heure_fin,
                'createur'=>$login
            );

            if	($this->ModeleSondage->addSondage($data)){
                echo "";
            }            
            
            $this->load->view('templates/header');
            $this->load->view('page',$deco);
            $this->load->view('templates/footer');
            
        }
    }
}

?>