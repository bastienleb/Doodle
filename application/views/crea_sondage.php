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
            <div class="contenu"><label> Titre </label> <input type="text" name="titre" required><br></div>
            <div class="contenu"><label> Lieu </label> <input type="text" name="lieu" required><br></div>
            <div class="contenu"><label> Descriptif </label> <input type="text" name="descriptif" required><br></div>
            <div class="contenu"><label> Date début </label> <input type="date" min="<?php echo date('Y-m-d'); ?>" name="date_debut"  required><br></div>
            <div class="contenu"><label> Date fin </label> <input type="date" min="<?php echo date('Y-m-d'); ?>" name="date_fin" required><br></div>
            <div class="contenu"><label> Heure début </label> <input type="time" name="heure_debut" min="00h00" required><br></div>
            <div class="contenu"><label> Heure fin</label>  <input type="text" name="heure_fin"  max="23h59"  placeholder="maximum 23h59" step="900" onfocus="this.type='time'" required><br> 
            <input type="hidden" name="login" value='<?php echo($_SESSION['login'])?>'class="bouton3" required>
            <input type="submit" value="Créer le sondage" class="bouton3">
        </form>
    </div>
</fieldset>

<fieldset class='liste_sondage_user'>
    <?php
    echo "  <legend>Sondage créer  </legend>";

    foreach($sondages as $sondage){
        echo form_open('admin/resultat',array('method'=>'get','class'=>'former_sondage'));
        echo form_hidden('cle',hash("ripemd160",$sondage->titre));
        echo "<p class='former_sondage'>". form_submit("",$sondage->titre)."<a href='../admin/delete/$sondage->titre'><i class='fa fa-times'></i></a> </p>" ;
         
        echo form_close();
    }   
    ?>
</fieldset>

<style>
body{
    overflow: hidden;
}
</style>
