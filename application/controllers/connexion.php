<?php 
class Connexion extends CI_Controller {

    public function index(){
        
        $this->load->model('ModeleInscription');
        $login = filter_input(INPUT_POST,"login",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);

        echo $login." ".$password;
/*
        if($login !== NULL  && $password !== NULL){
            $user['login'] = $login;
            $user['password'] =$password;
        }
        else{
            $user['login'] = "azertyuiopqsdfghjklmwxcvbn";
            $user['password'] ="azertyuiopqsdfghjklmwxcvbn";
        }

        if(ModeleInscription :: checkUser($user)){
            $message="";
            $tmp=1;
            $login = $email = $password = $prenom = $nom =" ";
        }else{
            $tmp=0;
            if($user['login'] =="azertyuiopqsdfghjklmwxcvbn" && $user['password']=="azertyuiopqsdfghjklmwxcvbn")
                $message="";
            else
                $message = "pseudo ou mot de passe incorrect";
        }*/

        echo $message;

        $this->load->view('templates/header');
        if($tmp==1){
            session_start();
            $_SESSION['auth']= 1;
            $_SESSION['login']=$user['login'];
            header('Location:../home/jeux');
        }
        else{
            $this->load->view('connexion');
        }
        $this->load->view('templates/footer');
    }

    public function inscription_page()
	{
        $this->load->helper('form');
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
                header('Location:../connexion');
            }
        }
    }

    
     
}

?>


