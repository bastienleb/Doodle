<?php
    class Connection {
        
/* ------------------connection  la BDD------------------ */
        public static function Connect() {
            $link = mysqli_connect("localhost","leblet","leblet","leblet");
            if(!$link)
                die("<p>connexion impossible</p>");
            return $link;
        }
    }

?>