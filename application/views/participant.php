<?php
/*
###########################################################################
#                                                                         #
#                                                                         #
#     #####        #####       #####      #####      #         ######     #
#     #    #      #     #     #     #     #    #     #         #          #
#     #     #    #       #   #       #    #     #    #         #          #
#     #     #    #       #   #       #    #     #    #         ####       #
#     #     #    #       #   #       #    #     #    #         #          #
#     #    #      #     #     #     #     #    #     #         #          #
#     #####        #####       #####      #####      ######    ######     #
#                                                                         #
#                                                                         #
#                Réalisé par Bastien LEBLET & Kévin METRI                 #
#                                                                         #
#                                                                         #
###########################################################################
*/
?>


<table>
<?php
    foreach($titres as $titre){
        $titre_hash= hash("ripemd160",$titre->titre);
        
        $test;
        $tmp=0;
        
        if($_GET['cle']==$titre_hash){
            $date_deb=date("l d-m-Y", strtotime($titre->date_debut));
            $date_finn=date("l d-m-Y", strtotime($titre->date_fin));

            $heure_deb=date("H",strtotime($titre->heure_debut));
            $min_deb=date("i",strtotime($titre->heure_debut));
            $heure_finn=date("H",strtotime($titre->heure_fin));

            $date=$date_deb;
            $totd=1;
            $jour = array(null,$date_deb);
            
            echo "<form method='POST'>";
            
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
                            $choix=array(null);

                            $rdv[$jour[$k]][$o.":30"] = "<input type='checkbox' name='choix[]' value='".date('Y-d-m', strtotime($jour[$k]))." $heure $titre->titre'><label> choisir</label><br>";
                            
                            $rdv[$jour[$k]][$j] =  "<input type='checkbox' name='choix[]' value='".date('Y-d-m', strtotime($jour[$k]))." $heure $titre->titre'><label> choisir</label><br>";
                            
                            
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
            echo "<input type='submit' value='Valider' id='btn_choix'>";
            echo "</form>";

            if(isset($_POST["choix"])){
                foreach($_POST['choix'] AS $cle=>$value){
                    echo $cle, ' -> ', $value, '<br />';
                }
            }
        }
    }
?>
</table>


<script type="text/javascript">

    function message(){
        alert("créneaux ajouter");
        
    }
</script>
