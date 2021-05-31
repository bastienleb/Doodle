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

<fieldset class="connexion">
    <form method="POST">
        <div class="formulaire">
            <label for="login">Login <input type="text" id="nom" name="login" required></label><br>
            <label for="password">Password <input type="password" id="password" name="password" required></label><br>
            <br>
            <input type="submit" value="Connexion" class="bouton">
        </div>
    </form>
    <input type="submit" onclick="window.location.href='inscription_page'" value="Créer son compte" class="bouton">
</fieldset> 

<?php
$this->table->set_heading(array('login', 'password',''));


$t=array('table_open'=>'<table>');
$this->table->set_template($t);

$tmp=0;
foreach ($verif as $v){
   
   if($v->login == $_POST['login'] && password_verify($_POST['password'],$v->password)){
       $tmp=1;
    }
    
    if($tmp==1){
        session_start();
        $_SESSION['auth']= 1;
        $_SESSION['login']=$v->login;
        header('Location:../home/jeux');
        
    }
}



?>