<style type="text/css">
      
    </style>

<h1> ICI C'EST MA VUE DES PARTICIPANTS </h1>

<!-- <?php
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
?> -->

<table>
<?php
    $jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
    echo "<tr><th>Heure</th>";
    for($x = 1; $x < 8; $x++)
        echo "<th>".$jour[$x]."</th>";
    echo "</tr>";
    for($j = 0; $j < 24; $j += 0.5) {
        echo "<tr>";
        for($i = 0; $i < 7; $i++) {
            if($i == 0) {
                $heure = str_replace(".5", ":30", $j);
                if(substr($heure,-3,3) != ":30")
                    echo "<td class=\"time\" rowspan=\"2\">".$heure."h</td>";
            }
            echo "<td>";
            if(isset($rdv[$jour[$i+1]][$heure])) {
                echo $rdv[$jour[$i+1]][$heure];
            }
            echo "</td>";
        }
        echo "</tr>";
    }
?>
</table>

