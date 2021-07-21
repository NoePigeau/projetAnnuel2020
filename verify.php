<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vérification</title>
		<meta charset="utf-8">
		<meta name="description" content="Accueil">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="wrap">
			<?php include("header.php"); ?>		    
            <header class="masthead text-white text-center">
		        <div class="row">
			        <div class="col-xl-9 mx-auto">
                    <?php
                    require('config.php');

                    if(isset($_GET['activation_code']))
                    {
                        $activation_code = $_GET['activation_code'];
        
                        $q = 'SELECT active,activation_code FROM subscribers WHERE active = 0 AND activation_code = ?';
                        $req = $bdd->prepare($q); // $req = $bdd->query($q) on peut utiliser query quand il y n'y pas d'injection de contenu ex : requête SELECT
                        $req->execute([$_GET['activation_code']]);
                        $results = $req->FetchAll();

                        if(count($results) == 1 )
                        {
           
                          $q = "UPDATE subscribers SET active = 1 WHERE activation_code = ? LIMIT 1 ";
                          $req = $bdd->prepare($q);
                          $req->execute([$_GET['activation_code']]);
            

                          if(isset($req))
                          {
                            echo "Votre compte a été activé, vous pouvez maintenent vous connectez.";
                          }
                          else
                          {
                            echo $bdd->error;
                          }

                        }
                        else
                        {
                         echo "Ce compte est invalide ou est déjà vérifié";
                        }
                    }
                    else
                    {
                        die("Something went wrong"); 
                    }
                    ?>
                    </div>
		        </div>
	        </header>
        </div>
	</body>
</html>
