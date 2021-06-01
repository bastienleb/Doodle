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
class Securite_participant extends CI_Model {

	public static function Connect(){
		session_start();
        $test= $_GET['cle'];

		if(!isset($_SESSION['auth']) || $_SESSION['auth']!=1){
			header('Location:../connexion/');
		}
        else {
            header("Location:../participant/choix?cle=$test");
        }
	}

	public static function Deconnect(){
		session_destroy();
	}
}
?>