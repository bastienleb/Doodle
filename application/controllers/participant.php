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
class Participant extends CI_Controller {

    public function choix(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');
        $this->load->model('ModeleResultat');
        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data=array('titres' => $titres);
        

        
        //echo $_POST['jour']." ".$_POST['heure']."<br>";
        if(isset($_POST['titre']) && isset($_POST['choix'])){
            foreach($_POST['choix'] AS $cle=>$value){
                $tmp_jour=0;
                $tmp_heure=0;
                $login =$_SESSION['login'];
                $jourfin = array("null");
                $heurefin = array("null");
                $titre=$_POST['titre'];
                
                for($i=0;$i<10;$i++){
                    $jour=array($tmp_jour=>$value[$i]);
                    $jourfin=array_replace($jourfin,$jour);
                    
                    $tmp_jour++;
                }
                
                for($j=11;$j<13;$j++){
                    $heure=array($tmp_heure=>$value[$j]);
                    $heurefin=array_replace($heurefin,$heure);
                    $tmp=implode("", $heurefin);
                    //echo "tmp = $tmp <br>";

                    if(in_array(":",$heurefin)){
                        echo "pomme de teh";
                        $minute=array($tmp_heure+1=>"30");
                        $heurefin=array_replace($heurefin,$minute);
                    }
                    $tmp_heure++;
                    
                }

                $jourfinal = implode("", $jourfin);
                $heurefinal = implode("", $heurefin);

                // echo $login."<br>"; 
                // echo $jourfinal."<br>"; 
                // echo $heurefinal."<br>";  
                // echo $titre."<br>"; 
                // echo "/ <br>";

                $data_sondage=array(
                    'login'=>$login,
                    'jour'=> $jourfinal,
                    'heure'=>$heurefinal,
                    'titre_sondage'=>$titre
                );
                $creneaux =$this->ModeleResultat->addresultat($data_sondage);
                $add_data=array('creneaux' => $creneaux);

                $data=array_replace($data,$add_data);
                
            }
        }
            
        $this->load->view('templates/header');
        $this->load->view('participant',$data);
        $this->load->view('templates/footer');
    } 
}