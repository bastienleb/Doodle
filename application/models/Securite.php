<?php
class Securite extends CI_Model {

	public static function Connect(){
		session_start();

		if(!isset($_SESSION['auth']) || $_SESSION['auth']!=1){
			header('Location:../pages');
		}
	}

	public static function Deconnect(){
		session_destroy();
	}
}
?>