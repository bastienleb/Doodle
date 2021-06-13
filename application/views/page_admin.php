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

<?php
$tmptitre=0;
foreach($titres as $titre){
    $titre_hash= hash("ripemd160",$titre->titre);
    if($_GET['cle']==$titre_hash){ 
        $titre_fin=$titre->titre;
        if($tmptitre==0){
        echo "Le titre du sondage est : <b>".$titre->titre."</b>";

        echo "<a style='float:right'>Le lieu du sondage est : <b>".$titre->lieu."</b></a>";

        echo "<a'> descriptif: $titre->descriptif css a faire </a>";

        $tmptitre=1;
        }
    }
}


?>

<fieldset class ="div_lien">
    <legend class="legend_sondage" > Lien pour les participants du sondage </legend>
    <p>
        <span><a id="tocopy" >http://localhost/~leblet/projet_doodle/index.php/participant/choix?cle=<?php echo $_GET['cle'];?>  </a></span>
        <input type="button" value=" Copiez cette adresse" class="js-copy" data-target="#tocopy" >
    </p>


    <form method="post" id="clos">
        <input type="hidden" name="clore" value="1">
        <input type="submit" value="Clore le sondage">
    </form>
    
    <?php
    foreach($titres as $titre){
        if($titre->clos==1){
            echo "<h3 class=''>Le sondage est clos</h3>";
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
    <table border="5" cellspacing="0" align="center">
        

            <?php
            foreach($titres as $titre){
                $titre_hash= hash("ripemd160",$titre->titre);
            
            
                if($_GET['cle']==$titre_hash){
                    $date_deb=date("l d-m-Y", strtotime($titre->date_debut));
                    $date_finn=date("l d-m-Y", strtotime($titre->date_fin));
        
        
                    $date=$date_deb;
                    $totd=1;
                    $jour = array('heure',$date_deb);

                    while(!($date==$date_finn)){
                        $date = date("l d-m-Y", mktime (0,0,0,date("m", strtotime($titre->date_debut) ) ,date("d", strtotime($titre->date_debut) )+$totd,date("Y", strtotime($titre->date_debut) )));
                        $add = array($totd+1=>$date);
                        $adddeb = array(1=>$date_deb);
                        $jour = array_replace($jour,$add,$adddeb);
                        $totd++;
                    }
                    for ($i=0; $i <= $totd; $i++) { 
                        echo"<td class='test'>
                            <b>$jour[$i]</b>
                        </td>";
                    }
                }
            }
            ?>

        </tr>
        <tr>

        <?php
        
        $participant=array();
        $participant_tmp=0;
        //$tmpparticipant=0;
        foreach($titres as $titre){
            $titre_hash= hash("ripemd160",$titre->titre);

        
            if($_GET['cle']==$titre_hash){ 
                $heure_deb=date("H",strtotime($titre->heure_debut));
                $heure_finn=date("H",strtotime($titre->heure_fin));
                for ($j=$heure_deb; $j <=$heure_finn ; $j += 0.5) { 
                $heure = str_replace(".5", ":30", $j);
                if($heure<10 && !($j == $heure_deb)){
                    $heure=array(0,$heure);
                    $heure = implode("", $heure);
                    }

                    echo "<tr>
                        <td>
                        <b>".$heure."h</b></td>";
                        $tmp=0;
                    for ($h=0; $h < $totd  ; $h++) {
                        echo "<td>";
                        foreach($verif as $v => $val){
                            $titre_hash= hash("ripemd160",$titre_fin);
                            
                            if($_GET['cle']==$titre_hash){  
                                $add_participant_login=array($participant_tmp=>$val->login);
                                $add_participant_jour=array($participant_tmp+1=>$val->jour);
                                $add_participant_heure=array($participant_tmp+2=>$val->heure);
                                
                                $participant=array_replace($participant,$add_participant_login,$add_participant_jour,$add_participant_heure);
                            }
                            if($heure==$participant[2] && $jour[$h+1]==$participant[1]){
                                echo $participant[0]."<br>";
                            }
                        }
                        echo "</td>";
                    }

                    echo"</td>
                        </tr>";
                }
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