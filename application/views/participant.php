<style type="text/css">
      
    </style>

<h1> ICI C'EST MA VUE DES PARTICIPANTS </h1>


<table>
<?php
    foreach($titres as $titre){
        $titre_hash= hash("ripemd160",$titre->titre);
        
        if($_GET['cle']==$titre_hash){
            $date_deb=date("l d-m-Y", strtotime($titre->date_debut));
            $date_finn=date("l d-m-Y", strtotime($titre->date_fin));

            $heure_deb=date("H",strtotime($titre->heure_debut));
            $min_deb=date("i",strtotime($titre->heure_debut));
            $heure_finn=date("H",strtotime($titre->heure_fin));

            $date=$date_deb;
            $totd=1;
            $jour = array(null,$date_deb);

            $rdv[$date_deb]["16:30"] = "test";
            
            while(!($date==$date_finn)){
                $date = date("l d-m-Y", mktime (0,0,0,date("m", strtotime($titre->date_debut) ) ,date("d", strtotime($titre->date_debut) )+$totd,date("Y", strtotime($titre->date_debut) )));
                $add = array($totd+1=>$date);
                $adddeb = array(1=>$date_deb);
                $jour = array_replace($jour,$add,$adddeb);
                $totd++;
            }
            echo "<tr><th>Heure</th>";
            for($x = 1; $x < $totd+1; $x++)
            echo "<th>".$jour[$x]."</th>";
            echo "</tr>";
            for($j = $heure_deb; $j <= $heure_finn; $j += 0.5) {
                echo "<tr>";
                for($i = 0; $i < $totd; $i++) {
                    if($i == 0) {
                        $heure = str_replace(".5", ":30", $j);
                        echo "<td class=\"time\">".$heure."h</td>";
                    }
                    for($k=0 ; $k<= $totd ; $k++){
                        for($o=0 ; $o<=$j ; $o++){
                            $rdv[$jour[$k]][$o.":30"] = "<a href='#' class='btn_choix'> Choisir</a>";
                            $rdv[$jour[$k]][$j] = "<a href='#' class='btn_choix'> Choisir</a>";
                        }
                    }
                    echo "<td>";
                    if(isset($rdv[$jour[$i+1]][$heure])) {
                        echo $rdv[$jour[$i+1]][$heure];
                    }
                    echo "</td>";
                    
                }
                echo "</tr>";
            }
            
        }
    }
?>
</table>

