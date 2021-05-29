<fieldset >
    <form method="POST">
        <div class="formulaire">
            <label for="login">login <input type="text" id="nom" name="login" required></label><br>
            <label for="password">Password <input type="password" id="password" name="password" required></label><br>
            <br>
            <input type="submit" value="Connexion">
        </div>
    </form>
    <input type="submit" onclick="window.location.href='connexion/inscription_page'" value="Créer son compte">
</fieldset> 

<?php
$this->table->set_heading(array('login', 'password',''));



$t=array('table_open'=>'<table>');
$this->table->set_template($t);

$tmp=0;
foreach ($verif as $v){
    $tmp=1;
    $this->table->add_row(
        $v->login,
        $v->password,
        $tmp
    );

    if($tmp==1){
        session_start();
        $_SESSION['auth']= 1;
        $_SESSION['login']=$v->login;
        header('Location:../home/jeux');
       
    }

}

// if($tmp==1){
//     session_start();
//     $_SESSION['auth']= 1;
//     $_SESSION['login']=$user['login'];
//     header('Location:../home/jeux');
   
// }



?>