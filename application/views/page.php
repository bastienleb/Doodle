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
        <label for="date">Date <input type="date" name="date" required></label><br>
        <label for="heure_debut">Heure début<input type="time" name="heure_debut" required></label>
        <label for="heure_fin">Heure fin <input type="time" name="heure_fin" required></label><br>
        <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>'class="bouton3" required></label>
        <input type="submit" value="créer le sondage" class="bouton3">
    </form>
    </fieldset>
</div>

<div class="affi_sondage">
    <fieldset>
        <?php

        $this->table->set_heading(array('Sondage créer'));

        $template = array('table_open'=> '<table>');

        $this->table->set_template($template);

        foreach($sondages as $sondage){
            $this->table->add_row(
                $sondage->titre
            );
        }   
        echo $this->table->generate();
        ?>
    </fieldset>
</div>
<br>

<form method="get">
    <input type="hidden" name="deco" value="1">
    <input type="submit" value="deconnection">
</form>
