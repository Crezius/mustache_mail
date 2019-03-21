
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

            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            }

            if (isset($_GET["id"])){
                
                $prep = $bdd->prepare("SELECT * FROM donnee WHERE id=?");
            
                $prep->execute(array($_GET['id']));
                
                while ($donnees = $prep->fetch()) {
                    
                    
                     array_push($mail, array('date' => $donnees["date"], 
                                            'expediteur' =>$donnees["expediteur"], 
                                            'destinataire' =>$donnees["destinataire"], 
                                            'id' =>$donnees["id"], 
                                            'message' =>$donnees["message"]));
                    
                    //echo "</br><p id='coucou'>Le : ".$donnees['date']."<br/>De : <b>".$donnees['expediteur']."</b><br/>A : <b>".$user."</b><br/><br/>".$donnees['message']."</p>"
                }
            
            
            }
        
            require 'vendor\autoload.php';
            Mustache_Autoloader::register();
                
            $m = new Mustache_Engine(array(
                'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'\views') // "Hello World!"
            ));
	
        
        
?>

<?= $m->render('message', array('mail' => $mail)) ?>