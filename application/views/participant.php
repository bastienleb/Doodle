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

            $date=$date_deb;
            $totd=1;
            $jour = array(null,$date_deb);
            while(!($date==$date_finn)){
                $totd++;
                $date = date("l d-m-Y", mktime (0,0,0,date("m", strtotime($titre->date_debut) ) ,date("d", strtotime($titre->date_debut) )+$totd,date("Y", strtotime($titre->date_debut) )));
                $add = array($totd+2=>$date);
                $adddeb = array(1=>$date_deb);
                $jour = array_replace($jour,$add,$adddeb);
            }
            if($date==$date_finn && $totd==0){
                $totd=1;
            }
            echo "<tr><th>Heure</th>";
            for($x = 1; $x < $totd+1; $x++)
                echo "<th>".$jour[$x]."</th>";
            echo "</tr>";
            for($j = 0; $j < 24; $j += 0.5) {
                echo "<tr>";
                for($i = 0; $i < $totd; $i++) {
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
            
        }
    }
?>
</table>

