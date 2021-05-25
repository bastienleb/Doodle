<?php
class Inscription {
    public function addUser($user){
        $link = _getConnection();
    // attention injection sql !!

    $login = $user['login'];
    $email = $user['email'];
    $password = $user['password'];

    $hash = password_hash($password,PASSWORD_DEFAULT);

    $sqlQuery = "INSERT INTO user VALUES('$login','$email','$hash')";
    
    return mysqli_query($link,$sqlQuery);
    }
}


?>