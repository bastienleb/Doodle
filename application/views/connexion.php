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
?>

<style type="text/css">
body {
    overflow-y: scroll;
}
</style>

<img src="../../assets/img/logo2.png" class="logo_connexion"  alt="Logo DOODLE">

<fieldset class="connexion">
    <form method="POST">
        <div class="formulaire">
            <input type="text" id="nom" name="login" class="login" placeholder="login" required><br>
            <input type="password" id="password" name="password" class="password" placeholder="mot de passe" required><br>
            <br>
            <input type="submit" value="Connexion" class="bouton">
        </div>
    </form>
    <input type="submit" onclick="window.location.href='inscription_page'" value="Créer son compte" class="bouton">
</fieldset> 

<?php
    

$tmp=0;
foreach ($verif as $v){
   
   if($v->login == $_POST['login'] && password_verify($_POST['password'],$v->password)){
       $tmp=1;
       echo $v->login." ".$v->password."<br>";
       echo $_POST['login']." ".$_POST['password'];
    }
    
    if($tmp==1){
        session_start();
        $_SESSION['auth']= 1;
        $_SESSION['login']=$v->login;
        header('Location:../home/jeux');   
    }
}
?>