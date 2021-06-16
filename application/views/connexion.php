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
            <input type="text" id="nom" name="login" class="login" placeholder="Login" required><br>
            <input type="password" id="password" name="password" class="password" placeholder="Mot de passe" required><br>
            <br>
            <input type="submit" value="Connexion" class="bouton">
        </div>
    </form>
    <input type="submit" onclick="window.location.href='inscription_page'" value="Créer son compte" class="bouton">
</fieldset> 

<?php

?>