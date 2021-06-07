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
    <p class="connected">Connecté en tant que <b>  <?php  echo$_SESSION['login'] ?></b></p>    
   
    <img src="../../assets/img/logo3.png" class="logo_sondage"  alt="Logo DOODLE">
    
    <?php
    if(isset($_GET['deco'])){
        Securite::Deconnect();
        header('Location:../connexion/');
    }

    ?>


    <form method="get" >
        <input type="hidden" name="deco" value="1">
        <input type="submit" value="déconnection" class="btn_bar">
    </form>
  
</div>



<fieldset class="creer_sondage" >
<legend>Créer un sondage  </legend>
    <div>
        <form method="POST">
            <input type="text" name="titre" placeholder="titre" required><br>
            <input type="text" name="lieu" placeholder="lieu" required><br>
            <input type="text" name="descriptif" placeholder="descriptif" required><br>
            <input type="text" min="<?php echo date('Y-m-d'); ?>" name="date_debut" placeholder="date début" onfocus="this.type='date'"  required><br>
            <input type="text" min="<?php echo date('Y-m-d'); ?>" name="date_fin" placeholder="date fin" onfocus="this.type='date'" required><br>
            <input type="text" name="heure_debut" min="00h00" placeholder="heure début" step="3600" onfocus="this.type='time'" required><br>
            <input type="text" name="heure_fin"  max="23h59"  placeholder="heure fin" step="3600" onfocus="this.type='time'" required><br> 
            <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>'class="bouton3" required>
            <input type="submit" value="Créer le sondage" class="bouton3">
        </form>
    </div>
</fieldset>

<fieldset class='liste_sondage_user'>
    <legend>Sondage créer  </legend>
    <?php

    foreach($sondages as $sondage){
        echo form_open('admin/resultat',array('method'=>'get','class'=>'former_sondage'));
        echo form_hidden('cle',hash("ripemd160",$sondage->titre));
        echo "<p class='former_sondage'>". form_submit("",$sondage->titre)."<a href='#' onclick='test()'><i class='fa fa-times croix'></i></a> </p>" ;
         
        echo form_close();
        $titre=$sondage->titre;
        ?>
        <script type="text/javascript">
        function test(){
            if ( confirm( "Suprimer le sondage ?" )) {
                location.replace("../admin/delete/<?php echo $titre ?>");
            }

        }
        </script>
        <?php
    }   
    
    ?>
</fieldset>


<style>
body{
    overflow: hidden;
}
</style>
