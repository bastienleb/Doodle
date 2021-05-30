

<h1> ICI C'EST MA VUE DES PARTICIPANTS </h1>

<?php
 foreach($titres as $titre){
    $titre_hash= hash("ripemd160",$titre->titre);
    
    if($_GET['cle']==$titre_hash){
      echo "titre =".$titre->titre."<br>";  
      echo "lieu = ".$titre->lieu."<br>";
      echo "descriptif = ".$titre->descriptif."<br>";
      echo "date début = ".$titre->date_debut."<br>";
      echo "date fin = ".$titre->date_fin."<br>";
      echo "heure début = ".$titre->heure_debut."<br>";
      echo "heure fin = ".$titre->heure_fin."<br>";
      echo "créateur = ".$titre->createur;

    }
  }
?>

