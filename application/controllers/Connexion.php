<?php 
class Connexion extends CI_Controller {

    public function index()
	{
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
        }

        echo $message;

        $this->load->view('templates/header');
        if($tmp==1){
            session_start();
            $_SESSION['auth']= 1;
            $_SESSION['login']=$user['login'];
            $this->load->view('page');
        }
        else{
            $this->load->view('connexion');
        }
        $this->load->view('templates/footer');
    }
     
}

?>


