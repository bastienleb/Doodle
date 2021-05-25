<?php
class ModeleInscription extends CI_Model {
    public static function addUser($user){
        require('Connection.php');
        $link = Connection::Connect();
        

        $login = $user['login'];
        $email = $user['email'];
        $password = $user['password'];
        $prenom = $user['prenom'];
        $nom = $user['nom'];

        $hash = password_hash($password,PASSWORD_DEFAULT);

        $resultat =  mysqli_query($link,"INSERT INTO doodle_user 
        VALUES('$login','$hash','$nom','$prenom','$email')");
        
        
        return $resultat;
    }
    public static function checkUser($user){
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