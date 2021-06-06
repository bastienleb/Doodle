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

<img src="../../assets/img/logo2.png" class="logo_inscription"  alt="Logo DOODLE">

<form method="post">

	<fieldset class="inscription">
		<input type="text" name="login" placeholder="login" required><br>
		<input type="password" name="password" placeholder="password" required><br>
		<input type="text" name="nom" placeholder="Nom" required><br>
		<input type="text" name="prenom" placeholder="Prénom" required><br>
		<input type="email" name="email" placeholder="email" required><br>
	
		<input type="submit" value='Créer le compte' class="bouton2">

	</fieldset>
</form>