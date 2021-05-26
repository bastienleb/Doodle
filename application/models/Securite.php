<?php
class Securite extends CI_Model {

	public static function Connect(){
		session_start();

		if(!isset($_SESSION['auth']) || $_SESSION['auth']!=1){
			echo "pas bon";
			header('Location:../');
		}
	}

	public static function Deconnect(){
		session_destroy();
	}
}
?>