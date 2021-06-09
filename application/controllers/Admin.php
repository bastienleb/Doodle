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

class Admin extends CI_Controller {

    public function resultat(){
        $this->load->model('Securite');
        $this->load->model('ModeleUser');
        $this->load->model('ModeleResultat');
        $this->load->model('ModeleSondage');

        Securite::Connect();

        $titres = $this->ModeleUser->get_titre();
        $data =array('titres' => $titres);

        foreach($titres as $titre){
            $heure_deb=date("H",strtotime($titre->heure_debut));
            $heure_finn=date("H",strtotime($titre->heure_fin));
            $titre_hash= hash("ripemd160",$titre->titre);

            $clore=$this->input->post('clore');

            if($_GET['cle']==$titre_hash){
                    $verif = $this->ModeleResultat->get_resultat($titre->titre); 
                    $data_verif=array('verif' => $verif);
                    $data=array_replace($data,$data_verif);
            }

            if(isset($clore)){
                $data_update=array('clos'=>$clore); 
                $update= $this->ModeleSondage->update_sondage($data_update,$titre->titre);
            }
        }

        $tout=$this->ModeleSondage->get_sondage($_SESSION['login']);
        $data_tout = array('tout',$tout);

        foreach($tout as $ta){
            $date_deb=date("l d-m-Y ", strtotime($titre->date_debut));
            $date_finn=date("l d-m-Y ", strtotime($titre->date_fin));

            $heure_deb=date("H",strtotime($titre->heure_debut));
            $heure_finn=date("H",strtotime($titre->heure_fin));

            $date=$date_deb;
            $totd=1;
            $jour = array(null);

            while(!($date==$date_finn)){
                $date = date("l d-m-Y ", mktime (0,0,0,date("m", strtotime($ta->date_debut) ) ,date("d", strtotime($ta->date_debut) )+$totd,date("Y", strtotime($ta->date_debut) )));
                $add = array($totd+1=>$date);
                $adddeb = array(0=>$date_deb);
                $jour = array_replace($jour,$add,$adddeb);
                $totd++;
            }

            var_dump($jour);
        }
        


        $this->load->view('templates/header');
        $this->load->view('page_admin',$data);
        $this->load->view('templates/footer');
    }

    public function delete($titre){
        
        $this->load->model('Securite');
        $this->load->model('ModeleSondage');
        $this->load->model('ModeleResultat');
        
        Securite::Connect();
        
        $titre=str_replace("%20"," ",$titre);
        echo $titre;
        
        if($this->ModeleSondage->sup_sondage($titre) && $this->ModeleResultat->sup_reponse($titre)){
            header("Location:../../home/jeux");
        }
    }



}

?>