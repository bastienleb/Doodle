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
        $this->load->model('ModeleUser');
        $this->load->model('ModeleResultat');

        $titres = $this->ModeleUser->get_titre();
        $data=array('titres' => $titres);

        $titre=$this->input->post('titre');
        $choix[]=$this->input->post('choix');
        
        if(isset($titre) && isset($choix)){
            echo "Titre :<b>".$_POST['titre']."</b><br>";
            foreach($choix AS $cle=>$value){
                $tmp_jour=0;
                $tmp_heure=0;
                $max=3;
                $login =$_POST['login'];
                $jourfin = array("null");
                $heurefin = array("null");
                $titre=$_POST['titre'];

                if(strlen($value)>=23 && $value[strlen($value)-3]== ":"){
                    $max=6;
                }
                
                for($i=0;$i<=strlen($value)-$max;$i++){
                    $jour=array($tmp_jour=>$value[$i]);
                    $jourfin=array_replace($jourfin,$jour);
                                        
                    $tmp_jour++;
                }

                for($j=strlen($value)-$max;$j<strlen($value);$j++){
                    $heure=array($tmp_heure=>$value[$j]);
                    $heurefin=array_replace($heurefin,$heure);
                    $tmp=implode("", $heurefin);
                    
                    $tmp_heure++;
                }
                
                    
                   
                $jourfinal = implode("", $jourfin);
                $heurefinal = implode("", $heurefin);               

                $data_sondage=array(
                    'login'=>$login,
                    'jour'=> $jourfinal,
                    'heure'=>$heurefinal,
                    'titre_sondage'=>$titre
                );

                if($this->ModeleResultat->addresultat($data_sondage)){
                    header('Location:valider');
                }
                
            }
        }
            
        $this->load->view('templates/header');
        $this->load->view('participant',$data);
        $this->load->view('templates/footer');
    } 

    public function valider(){
        $this->load->view('templates/header');
        $this->load->view('creneaux');
        $this->load->view('templates/footer');
    }
}