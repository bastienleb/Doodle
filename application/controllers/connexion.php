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

class Connexion extends CI_Controller {

    public function index(){
        
        $this->load->model('ModeleInscription');
        
        $login = filter_input(INPUT_POST,"login",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);

        if($login !== NULL  && $password !== NULL){
            $user['login'] = $login;
            $user['password'] =$password;
        }
        else{
            $user['login'] = "azertyuiopqsdfghjklmwxcvbn";
            $user['password'] ="azertyuiopqsdfghjklmwxcvbn";
        }


        $verif=$this->ModeleInscription->RecupLog($user);
        $data=array('verif'=>$verif);

         
        $this->load->view('templates/header');
        $this->load->view('connexion',$data);
        $this->load->view('templates/footer');

    }

    public function inscription_page()
	{
		$this->load->library('form_validation');
        $this->load->model('ModeleInscription');

        $this->form_validation->set_rules('login', 'login', 'required|is_unique[doodle_user.login]');
		$this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_rules('nom', 'nom', 'required|trim');
		$this->form_validation->set_rules('prenom', 'prenom', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'valid_email|trim');

        $this->form_validation->set_message('is_unique', '{field} est déjà présent dans la base.');


        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
			$this->load->view('inscription');
			$this->load->view('templates/footer');
        }
        else{
            $login = $this->input->post('login');
            $password = $this->input->post('password');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $email = $this->input->post('email');
            
            $data=array(
                'login'=>$login,
                'password'=> password_hash($password,PASSWORD_DEFAULT),
                'nom'=>$nom,
                'prenom'=>$prenom,
                'email'=>$email
            );
            
            if	($this->ModeleInscription->addUser($data)){
                header('Location:../connexion/');
            }
        }
    }

    
     
}

?>


