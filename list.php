<?php 
            
            //Info base
            $dbhost = "localhost";
            $dbuser = "me";
            $dbpass = "mdp";
            $db = "mail";
            $user="";
            $Liste="";
            $Message="";


            $mail = array();

            try {
                $bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }


            if(isset($_GET['user'])) {
                
                $user = $_GET['user'];
                
                $indice=0;
                $prep = $bdd->prepare("SELECT * FROM donnee WHERE destinataire=? ORDER BY date");
                $prep->execute(array($user));
                
                
                while ($donnees = $prep->fetch()) {

                    $point_fin=""; 
                    $apercu = substr($donnees['message'], 0, 10);
                    
                    //echo "<p>".$apercu."</p>";
                    
                    if(strlen($donnees['message'])>10){
                       
                        
                        $point_fin="...";

                    }
                    
                    array_push($mail, array('date' => $donnees["date"], 
                                            'expediteur' =>$donnees["expediteur"], 
                                            'id' =>$donnees["id"], 
                                            'message' =>$apercu,
                                            'indice' => $indice));
   

                    
                    /*
                    $m = new Mustache_Engine;
                    echo $m->render('Hello {{planet}}', array('planet' => 'World!')); // "Hello World!"
                    */
                    /*
                    echo "<p>yop</p>";
                    
                    echo "<li id=\"liste_mail".$indice."\" class=\"liste_mail\" onclick=\"afficherMail(".$donnees['id'].")\">
                                <a id=\"listeMail\"  href=\"#l\">0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
                                    ".$donnees['date']." <b>".$donnees['expediteur']."</b> ".$donnees['id']." : ".$apercu."".$point_fin."
                                </a>
                                <a id=\"croix\" onclick=\"supprimer(".$donnees['id'].", '".$indice."')\" href=\"#\">
                                    <span class=\"croixgauche\"></span>
                                    <span class=\"croixdroite\"></span>
                                </a>
                            </li>";
                    */
                    
                    
                    
                    $indice++;
            }
                
                 
            require 'vendor\autoload.php';
            Mustache_Autoloader::register();
                
            $m = new Mustache_Engine(array(
                'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'\views') // "Hello World!"
            ));
	}
        
        
?>

<?= $m->render('liste', array('mail' => $mail)) ?>



