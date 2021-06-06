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

        if(isset($_GET['deco'])){
            Securite::Deconnect();
            header('Location:../connexion/');
        }

     ?>
<p class="connected">Connecté en tant que <b>  <?php  echo$_SESSION['login'] ?></b></p>    

    <form method="get" >
        <input type="hidden" name="retour" value="1">
        <input type="submit" value="retour" class="btn_retour" >
    </form>

    <img src="../../assets/img/logo1.png" class="logo_admin"  alt="Logo DOODLE">

    <form method="get" >
        <input type="hidden" name="deco" value="1">
        <input type="submit" value="déconnection" class="btn_deco">
    </form>
  
</div>

<fieldset class ="div_lien">
    <legend class="legend_sondage" > Lien pour les participants du sondage </legend>
    <p>
        <span><a id="tocopy" >http://localhost/~leblet/projet_doodle/index.php/participant/choix?cle=<?php echo $_GET['cle'];?>  </a></span>
        <input type="button" value=" Copiez cette adresse" class="js-copy" data-target="#tocopy" >
    </p>


    <form method="post" id="clos">
        <input type="hidden" name="clore" value="1">
        <input type="submit" value="clore le sondage">
    </form>
    
    <?php
    foreach($titres as $titre){
            if($titre->clos==1){
                echo "Le sondage est clos";
                ?>
                <script type="text/javascript">
                    document.getElementById('clos').style.display = 'none';
                </script>

                <?php
            }   
        }
    ?>
</fieldset>






<fieldset>

<legend class="legend_sondage">  Disponibilité des différents participants suite au sondage </legend>

    <table>
    <?php
        $tmp=0;
        foreach($titres as $titre){              
            $titre_hash= hash("ripemd160",$titre->titre);
            $tmp=0;
            
            if($_GET['cle']==$titre_hash){
                $date_deb=date("l d-m-Y ", strtotime($titre->date_debut));
                $date_finn=date("l d-m-Y ", strtotime($titre->date_fin));

                $heure_deb=date("H",strtotime($titre->heure_debut));
                $heure_finn=date("H",strtotime($titre->heure_fin));

                $date=$date_deb;
                $totd=1;
                $jour = array(null,$date_deb);
                
                echo "<form method='POST'>";
                
                while(!($date==$date_finn)){
                    $date = date("l d-m-Y ", mktime (0,0,0,date("m", strtotime($titre->date_debut) ) ,date("d", strtotime($titre->date_debut) )+$totd,date("Y", strtotime($titre->date_debut) )));
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
                                $rdv[$jour[$k]][$heure] =  "creneaux vide";

                            }
                        }
                        foreach($verif as $v){
                            $heure_finnnnnn=trim($v->heure);
                            $tmp=$v->login;
                            foreach ($verif as $q) {
                                $rdv["$v->jour"][$heure_finnnnnn] ="<p class='plein'>$tmp</p>";
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
            }
            
        }
    ?>
    </table>

</fieldset>

<script type="text/javascript">
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
                alert('Copié !');
            }
        }
        catch(err) {
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
