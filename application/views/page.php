<?php
echo "Connecter en temps que  <b>".$_SESSION['login']."</b>";
?>
<h1>Selection de sondage </h1>

<div class="creer_sondage">
    <p>on peut ici créer les sondage plutot que de faire une page apart</p>
    <input type="submit" href="#" value="créer un sondage">
</div>
<div class="affi_sondage">
    <p>on peut ici afficher les sondage créer plutot que de faire une page apart</p>
    <input type="submit" href="#" value="regarder les sondages">
</div>
<br>

<form method="POST">
    <input type="hidden" name="deco" value="1">
    <input type="submit" value="deconnection">
</form>
