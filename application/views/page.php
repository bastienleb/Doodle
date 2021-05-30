<?php
echo "Connecter en temps que  <b>".$_SESSION['login']."</b>";
if(isset($_GET['deco'])){
    Securite::Deconnect();
    header('Location:../connexion/');
}
?>
<h1>Selection de sondage </h1>

<div>
<fieldset class="creer_sondage" >
    <form method="POST">
        <label for="titre">Titre <input type="text" name="titre" required></label><br>
        <label for="lieu">Lieu <input type="text" name="lieu" required></label><br>
        <label for="descriptif">Descriptif <input type="text" name="descriptif" required></label><br>
        <label for="date_debut">Date début <input type="date" name="date_debut" required></label><br>
        <label for="date_fin">Date fin <input type="date" name="date_fin" required></label><br>
        <label for="heure_debut">Heure début<input type="time" name="heure_debut" required></label>
        <label for="heure_fin">Heure fin <input type="time" name="heure_fin" required></label><br>
        <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>'class="bouton3" required></label>
        <input type="submit" value="Créer le sondage"  onclick="window.location.href='page_admin.php'" class="bouton3">
    </form>
    </fieldset>
</div>

<div class="affi_sondage">
    <fieldset>
        <?php
        echo "<h3>Sondage créer</h3>";

        foreach($sondages as $sondage){
                echo form_open('admin/resultat',array('method'=>'get'));
                echo form_hidden('cle',hash("ripemd160",$sondage->titre));
                echo form_submit("",$sondage->titre);
                echo form_close();
        }   
        ?>
    </fieldset>
</div>
<br>

<form method="get">
    <input type="hidden" name="deco" value="1">
    <input type="submit" value="deconnection">
</form>
