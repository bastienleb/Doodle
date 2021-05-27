<?php 
class Connexion extends CI_Controller {

    public function index(){
        
        $this->load->model('ModeleInscription');
        $login = filter_input(INPUT_POST,"login",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);

        echo $login." ".$password;

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
            header('Location:../home/jeux');
        }
        else{
            $this->load->view('connexion');
        }
        $this->load->view('templates/footer');
    }

    public function inscription_page()
	{
        $this->load->model('ModeleInscription');

        $login = filter_input(INPUT_POST,"login",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);
        $nom = filter_input(INPUT_POST,"nom",FILTER_DEFAULT);
        $prenom = filter_input(INPUT_POST,"prenom",FILTER_DEFAULT);
        $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
        
        //echo "mail: $email login: $login mdp: $password prenom: $prenom nom: $nom";
        
        if($login !== NULL && $email !== NULL && $password !== NULL && 
           $prenom !== NULL && $nom !== NULL && $email !== FALSE){
            //rajouter des contrainte
            $user['login'] = $login;
            $user['email'] = $email;
            $user['password'] = $password;
            $user['nom'] = $password;
            $user['prenom'] = $password;
            
            
            
            if(ModeleInscription :: addUser($user)){
                $message = "Compte créé !";
                $login = $email = $password = $prenom = $nom =" ";
            }else{
                $message = "Donnée non valide";
            }
            
            echo $message;
        }
        
		$this->load->view('templates/header');
        $this->load->view('inscription');
        $this->load->view('templates/footer');
	}

    
     
}

?>


