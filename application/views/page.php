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
        <label for="date_debut">Date début <input type="date" min="<?php echo date('Y-m-d'); ?>" name="date_debut"  required></label><br>
        <label for="date_fin">Date fin <input type="date" min="<?php echo date('Y-m-d',strtotime('+1 day')); ?>" name="date_fin" required></label><br>
        <label for="heure_debut">Heure début<input type="time" name="heure_debut" required></label>
        <label for="heure_fin">Heure fin <input type="time" name="heure_fin" required></label><br>
        <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>'class="bouton3" required></label>
        <input type="submit" value="Créer le sondage" class="bouton3">
    </form>
    </fieldset>
</div>

    <fieldset class='liste_sondage_user'>
        <?php
        echo "  <legend>Sondage créer  </legend>";

        foreach($sondages as $sondage){
            echo form_open('admin/resultat',array('method'=>'get'));
            echo form_hidden('cle',hash("ripemd160",$sondage->titre));
            echo "<p class='former_sondage'>". form_submit("",$sondage->titre)."</p>";
            echo form_close();
        }   
        ?>
    </fieldset>
    
<br>

<form method="get">
    <input type="hidden" name="deco" value="1">
    <input type="submit" value="deconnection">
</form>
