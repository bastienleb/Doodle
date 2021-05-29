<?php
echo "Connecter en temps que  <b>".$_SESSION['login']."</b>";
if(isset($_GET['deco'])){
    Securite::Deconnect();
    header('Location:../connexion/');
}
?>
<h1>Selection de sondage </h1>

<div class="creer_sondage">
    <fieldset>
    <form method="POST">
        <label for="titre">Titre <input type="text" name="titre" required></label><br>
        <label for="lieu">Lieu <input type="text" name="lieu" required></label><br>
        <label for="descriptif">Descriptif <input type="text" name="descriptif" required></label><br>
        <label for="date">Date <input type="date" name="date" required></label><br>
        <label for="heure_debut">Heure debut<input type="time" name="heure_debut" required></label>
        <label for="heure_fin">Heure fin <input type="time" name="heure_fin" required></label><br>
        <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>' required></label>
        <input type="submit" value="créer le sondage">
    </form>
    </fieldset>
</div>
<div class="affi_sondage">
    <fieldset>
        <p>on peut ici afficher les sondage créer plutot que de faire une page apart</p>
        <input type="submit" href="#" value="regarder les sondages">
    </fieldset>
</div>
<br>

<form method="get">
    <input type="hidden" name="deco" value="1">
    <input type="submit" value="deconnection">
</form>
