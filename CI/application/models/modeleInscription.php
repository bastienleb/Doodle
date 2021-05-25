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
}
?>