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

<div class="bar">
    <?php
        if(isset($_GET['retour'])){
            header('Location:../home/jeux');
        }

        $tmp=0;
        foreach($titres as $titre){
            if($tmp==0){
            echo "Le titre du sondage est : <b>".$titre->titre."</b>";

            echo "<a style='float:right'>Le lieu du sondage est : <b>".$titre->lieu."</b></a>";
            $tmp=1;
            }
        }

     ?>
    

    <img src="../../assets/img/logo1.png" class="logo_participant"  alt="Logo DOODLE">

    <form method="get" >
        <input type="hidden" name="deco" value="1">
        <input type="submit" value="déconnection" class="btn_deco">
    </form>
  
</div>

<?php
foreach($titres as $titre){
    echo "descriptif: $titre->descriptif css a faire ";
    if($titre->clos==1){
        echo "Le sondage a été clos";
        $tmp=0;
    }
    else{
        $tmp=1;
    }
}

echo "<form method='POST'>";
echo "<table>";

echo "<input type='text' name='login' required class='nom_participant'  placeholder='Nom'>";
echo "<input type='submit' value='Valider' id='btn_choix' class='btn_choix'>";

foreach($titres as $titre){
    
    if($tmp==1){
        $titre_hash= hash("ripemd160",$titre->titre);
        
        
        if($_GET['cle']==$titre_hash){
            $date_deb=date("l d-m-Y", strtotime($titre->date_debut));
            $date_finn=date("l d-m-Y", strtotime($titre->date_fin));

            $heure_deb=date("H",strtotime($titre->heure_debut));
            $heure_finn=date("H",strtotime($titre->heure_fin));

            $date=$date_deb;
            $totd=1;
            $jour = array(null,$date_deb);
            
            
            
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
                        if($heure<10 && !($j == $heure_deb)){
                            $heure=array(0,$heure);
                            $heure = implode("", $heure);
                        }
                        echo "<td class=\"time\">".$heure."h</td>";
                    }
                    for($k=0 ; $k<= $totd ; $k++){
                        for($o=0 ; $o<=$j ; $o++){
                            $choix=array(null);
                        
                            $rdv[$jour[$k]][$o.":30"] = "<input type='checkbox' name='choix[]' value='$jour[$k] $heure'>";
                            
                            $rdv[$jour[$k]][$j] =  "<input type='checkbox' name='choix[]' value='$jour[$k] $heure'>";
                            
                            
                        }
                    }
                    echo "<td>";
                    if(isset($rdv[$jour[$i+1]][$j])) {
                        echo $rdv[$jour[$i+1]][$j];
                    }
                    echo "</td>";
                    
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='hidden' value='$titre->titre' name='titre'>";
            echo "</form>";
        }
    }
}
?>