<h1>Créer son compte</h1>
<form method="post">
	<fieldset>
		<label for="login">login <input type="text" name="login" required></label><br>
		<label for="password">Password <input type="password" name="password" required></label><br>
		<label for="nom">nom <input type="text" name="nom" required></label><br>
		<label for="prenom">prenom <input type="text" name="prenom" required></label><br>
		<label for="email">email <input type="email" name="email" required></label><br>
	
		<input type="submit" value='Créer le compte'>

	</fieldset>
</form>
<input type="submit" onclick="window.location.href='connexion_page'" value="login">