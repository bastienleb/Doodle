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

     ?>
<p class="connected">Connecter en temps que <b>  <?php  echo$_SESSION['login'] ?></b></p>    

    <form method="get" >
        <input type="hidden" name="retour" value="1">
        <input type="submit" value="retour" class="btn_retour" >
    </form>

    <h2 class="titre">Selection de sondage </h2>

    <form method="get" >
        <input type="hidden" name="deco" value="1">
        <input type="submit" value="deconnection" class="btn_deco">
    </form>
  
</div>

<fieldset>
    <legend class="legend_sondage" > Lien pour les participants du sondage </legend>
    <p>
        <span><a id="tocopy" >http://localhost/~leblet/projet_doodle/index.php/participant/choix?cle=<?php echo $_GET['cle'];?>  </a></span>
        <input type="button" value=" Copiez cette adresse :" class="js-copy" data-target="#tocopy" >
    </p>
</fieldset>


<fieldset>

<legend class="legend_sondage">  Disponibilité des différents participants suite au sondage </legend>

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

                                $rdv[$jour[$k]][$o.":30"] = "<i class='fa fa-mobile-phone'<i/> ";
                                
                                $rdv[$jour[$k]][$j] =  "<i class='fa fa-soccer-ball-o'<i/>";
                                //echo "<br> jour = $jour[$k] <br>";
                                //echo "heure = $j <br>";

                                foreach ($verif as $v ) {
                                    // echo "<br>".$v->login."    ";
                                    // echo "<br>".$v->jour."    ";   // PB DE CONVERSION 
                                    // echo "<br>".$v->heure."    ";
                                    // echo "<br>".$v->titre_sondage."    ";
                                    //$date_verif=);
                                    //echo "date_verif = ".date('l d-m-Y', strtotime($v->jour))." <br>";
                                    //$rdv[$v->jour][$v->heure] = $v->login;
                                }
                                
                                
                                
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

</fieldset>


<script type="text/javascript">



    function message(){
        alert("créneaux ajouter");
        
    }

    var btncopy = document.querySelector('.js-copy');
    if(btncopy) {
        btncopy.addEventListener('click', docopy);
    }

    function docopy() {
        var range = document.createRange();
        var target = this.dataset.target;
        var fromElement = document.querySelector(target);
        var selection = window.getSelection();

        range.selectNode(fromElement);
        selection.removeAllRanges();
        selection.addRange(range);

        try {
            var result = document.execCommand('copy');
            if (result) {
                // La copie a réussi
                alert('Copié !');
            }
        }
        catch(err) {
            // Une erreur est surevnue lors de la tentative de copie
            alert(err);
        }

        selection = window.getSelection();

        if (typeof selection.removeRange === 'function') {
            selection.removeRange(range);
        } else if (typeof selection.removeAllRanges === 'function') {
            selection.removeAllRanges();
        }
    }
</script>
