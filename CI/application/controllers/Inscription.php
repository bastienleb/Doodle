<?php
class Inscription extends CI_Controller {

    public function index()
	{
        $login = filter_input(INPUT_POST,"login",FILTER_DEFAULT);
        $password = filter_input(INPUT_POST,"password",FILTER_DEFAULT);
        $nom = filter_input(INPUT_POST,"nom",FILTER_DEFAULT);
        $prenom = filter_input(INPUT_POST,"prenom",FILTER_DEFAULT);
        $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);

        echo "mail: $email login: $login mdp: $password prenom: $prenom nom: $nom";

        if($login !== NULL && $email !== NULL && $password !== NULL && $prenom !== NULL 
        && $nom !== NULL && $email !== FALSE){
            //rajouter des contrainte
            $user['login'] = $login;
            $user['email'] = $email;
            $user['password'] = $password;
            $user['nom'] = $password;
            $user['prenom'] = $password;


        
            /*if(addUser($user)){
                $message = "Compte créé !";
                $login = $email = $password =" ";
            }else{
                $message = "Donnée non valide";
            }*/
        
            //echo $message;
        }

		$this->load->view('templates/header');
        $this->load->view('inscription');
        $this->load->view('templates/footer');
	}

    
}