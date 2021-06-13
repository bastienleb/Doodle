<div class="bar">
    <?php
        if(isset($_GET['retour'])){
            header('Location:../home/jeux');
        }

     ?>
    

    <img src="../../assets/img/logo1.png" class="logo_participant"  alt="Logo DOODLE">

    <form method="get" >
        <input type="hidden" name="deco" value="1">
        <input type="submit" value="déconnection" class="btn_deco">
    </form>
  
</div>


<h1>Le creneau est validé<h1>