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
		<label>Login </label><input type="text" name="login" required><br>
		<label>Password </label><input type="password" name="password" required><br>
		<label>Nom </label><input type="text" name="nom" required><br>
		<label>Prénom </label><input type="text" name="prenom" required><br>
		<label>Email </label><input type="email" name="email" required><br>
	
		<input type="submit" value='Créer le compte' class="bouton2">

	</fieldset>
</form>