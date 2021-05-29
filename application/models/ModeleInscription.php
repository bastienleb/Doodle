<?php
class ModeleInscription extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function addUser($data){
        return $this->db->insert('doodle_user', $data);
    }

    public function checkUser($user){
        require('Connection.php');
        $link = Connection::Connect();
    
        $login = $user['login'];
        $password = $user['password'];

        if($login=="azertyuiopqsdfghjklmwxcvbn" && $password=="azertyuiopqsdfghjklmwxcvbn"){
            return FALSE;
        }
    
        $resultat =  mysqli_query($link,"SELECT * FROM user WHERE login ='$login'");
    
        if (mysqli_num_rows($resultat) !=1) 
            return FALSE;
    
        $userBD = mysqli_fetch_assoc($resultat);
        $hash =$userBD['password'];
    
        return password_verify($password,$hash);
    }
}
?>