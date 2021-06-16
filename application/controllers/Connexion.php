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
        $interdiction1 = '<';
        $interdiction2 = '>';
        $interdiction3 = '/';

        if($login !== NULL  && $password !== NULL){
            $user['login'] = $login;
            $user['password'] =$password;
        }
        else{
            $user['login'] = "abcdefghijklmnopqrstuvwxyz";
            $user['password'] ="abcdefghijklmnopqrstuvwxyz";
        }

        $test1 = stripos($login, $interdiction1);
        $test2 = stripos($login, $interdiction2);
        $test3 = stripos($login, $interdiction3);
        
        if($test1 == true || $test2 == true || $test3 == true){
            echo "<div class='error'> une ou plusieurs valeurs contient des caracteres interdits !</div>";
            $this->load->view('templates/header');
            $this->load->view('connexion');
            $this->load->view('templates/footer');
        }


        if($verif=$this->ModeleInscription->RecupLog($user)){
            $data=array('verif'=>$verif);
        }else{
            if($user['login']!="abcdefghijklmnopqrstuvwxyz" && $user['password']!="abcdefghijklmnopqrstuvwxyz"){
                echo "<a class='error'>Le login ou le mot de passe est incorrect</a>";
            }
            $data=array();
        }

        foreach ($verif as $v){
            echo $v->login." et ".$user['login']."<br>"; 
            if($v->login == $user['login'] && password_verify($user['password'],$v->password)){
                session_start();
                $_SESSION['auth']= 1;
                $_SESSION['login']=$v->login;
                header('Location:../home/jeux'); 
            }
        }
     
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

            $interdiction1 = '<';
            $interdiction2 = '>';
            $interdiction3 = '/';

            $test1 = stripos($login, $interdiction1);
            $test2 = stripos($login, $interdiction2);
            $test3 = stripos($login, $interdiction3);
            $test4 = stripos($nom, $interdiction1);
            $test5 = stripos($nom, $interdiction2);
            $test6 = stripos($nom, $interdiction3);
            $test7 = stripos($prenom, $interdiction1);
            $test8 = stripos($prenom, $interdiction2);
            $test9 = stripos($prenom, $interdiction3);
            $test10 = stripos($email, $interdiction1);
            $test11 = stripos($email, $interdiction2);
            $test12 = stripos($email, $interdiction3);


            if($test1 == true || $test2 == true || $test3 == true|| $test4 == true || $test5 == true ||
               $test6 == true || $test7 == true || $test8 == true|| $test9 == true || $test10 == true ||
               $test11 == true || $test12 == true){
                echo "<div class='error'> une ou plusieurs valeurs contient des caracteres interdits !</div>";
                $this->load->view('templates/header');
                $this->load->view('inscription');
                $this->load->view('templates/footer');
            }
            else if($login=="abcdefghijklmnopqrstuvwxyz" && $password=="abcdefghijklmnopqrstuvwxyz"){
                echo "<div class='error'> login et mot de passe impossible !</div>";
                $this->load->view('templates/header');
                $this->load->view('inscription');
                $this->load->view('templates/footer');
            }
            
            else{
           
            
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

    
     
}

?>


