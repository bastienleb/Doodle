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

<form method="post">

	<fieldset class="inscription">
		<label for="login">Login <input type="text" name="login" required></label><br>
		<label for="password">Password <input type="password" name="password" required></label><br>
		<label for="nom">Nom <input type="text" name="nom" required></label><br>
		<label for="prenom">Prénom <input type="text" name="prenom" required></label><br>
		<label for="email">Email <input type="email" name="email" required></label><br>
	
		<input type="submit" value='Créer le compte' class="bouton2">

		<!-- <input type="submit" onclick="window.location.href='../connexion'" value="login" class="bouton2"> -->
	</fieldset>
</form>