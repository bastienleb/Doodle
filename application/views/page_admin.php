<form>
  <fieldset class="liste_participant">
    <legend>Liste des participants  </legend>

    <?php
    echo 'le titre ';
    echo $_GET['cle']."<br>";
    echo 'le titre ';

    foreach($titres as $titre){
      $titre_hash= hash("ripemd160",$titre->titre);
      
      if($_GET['cle']==$titre_hash){
        echo $titre->titre;  
      }
    }   

    ?>
  </fieldset>
</form>

<p>
    Copiez cette adresse : <a id="tocopy">http://localhost/~leblet/projet_doodle/index.php/participant/choix/<?php echo $_GET['cle'];?></a>
    <input type="button" value="Copier" class="js-copy" data-target="#tocopy">
</p>

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
