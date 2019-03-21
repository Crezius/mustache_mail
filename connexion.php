<?php


        //Info base
        $dbhost = "localhost";
        $dbuser = "me";
        $dbpass = "mdp";
        $db = "mail";
        $user="";
        $Liste="";
        $Message="";
        $indice=0;

        try {
            $bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }



                
        $user=$_GET['user'];
   
        
        $sql = "SELECT * FROM donnee WHERE destinataire='".$user."'";
        $reponse = $bdd->query($sql);
        while ($donnees = $reponse->fetch()) {

            $point_fin=""; 
            $apercu = substr($donnees['message'], 0, 10);
            if(strlen($donnees['message'])>10){
                $point_fin="...";
            }



            $Liste .= "<li class=\"liste_mail\" onclick=\"afficherMail(".$donnees['id'].")\">
                                <a id=\"listeMail\"  href=\"#l\">
                                    ".$donnees['date']." <b>".$donnees['expediteur']."</b> : ".$apercu."".$point_fin."
                                </a>
                                <a id=\"croix\" onclick=\"supprimer(".$donnees['id'].",'".$user."')\" href=\"#\">
                                    <span class=\"croixgauche\"></span>
                                    <span class=\"croixdroite\"></span>
                                </a>
                            </li>";

        }    

?>