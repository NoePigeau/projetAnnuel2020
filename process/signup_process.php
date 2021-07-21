<?php
 session_start();
 require('../config.php');

   if( $_POST['validator'] != 'valide')
   {
     header('location: ../signup.php?msg=captcha non valide');
     exit;
	 }


     //prenom : test longueur
    if(strlen($_POST['firstname']) < 3 || strlen($_POST['firstname']) > 20)
			{
        header('location: ../signup.php?msg=prenom invalide');
				exit;
			}

    //nom : test longueur
    if(strlen($_POST['lastname']) < 3 || strlen($_POST['lastname']) > 25)
        {
          header('location: ../signup.php?msg=email invalide');
          exit;
        }

	//email
    //existe ? et format valide

	if( !isset($_POST['email']) || !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))
			{
			  header('location: ../signup.php?msg=email invalide');
				exit;
			}


        $q = 'SELECT id FROM subscribers WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute([$_POST['email']]);
        $results = $req->FetchAll();

        if(count($results) > 0){
            header('location: ../signup.php?msg=email deja pris !!');
            exit;
         }

	//password
    //existe ? et longueur comprises 7 et 15 caractères

	if(!isset($_POST['password']) || strlen($_POST['password']) < 8 || !preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d).*$/',$_POST['password']))
			{
				header('location: ../signup.php?msg=password invalide: taille minimum de 8 caractères avec une majuscule et un chiffre');
				exit;
			}



  if($_POST['subscrition'] == 'coach')
  {
    $coach = 2;
    $bank_information = 0;

    $acceptable =	'application/pdf';

  	if($_FILES['coach_document']['type'] != $acceptable ) // type dans le tableau ?
  	{
  		header('location: ../signup.php?msg=le fichier n\'est pas un pdf');
  		exit;
  	}


      //vérification du poids du fichier

      $maxsize = 1024*1024*3; // limite du fichier à 3Mo

      if($_FILES['coach_document']['size'] > $maxsize)
      {

          header('location:  ../signup.php?msg=le fichier est trop volumineux ! ');
          exit;

      }

      //cherche si un dossier uploads existe, si non le crée.

      $path = '../coach_document';
      if(!file_exists($path)){
      	mkdir($path , 0777 , true);
      }

  	$filename = $_FILES['coach_document']['name']; // le nom d'origine du fichier

  	// renommer le fichier  (evite les doublons...)
  	$temp = explode('.', $filename);
  	$extension = end($temp); // pour récupérer l'extension (png / jpeg ...)
  	$timestamp = time();
  	$filename = 'coach_document' . $timestamp . '.' . $extension; // attention ne marche pas si deux fichiers sont uploadés dans la même seconde

  	// met l'image dans un dossier avec le chemin indiqué en dessous
  	$chemin_image = $path . '/' . $filename; // Définition du chemin final
  	move_uploaded_file($_FILES['coach_document']['tmp_name'], $chemin_image);

      $firstname = htmlspecialchars($_POST['firstname']);
      $lastname = htmlspecialchars($_POST['lastname']);
      $email = $_POST['email'];
      $activation_code = 0;
      $password = hash('sha256' , $_POST['password']); // hachage mdp
      
      $q = 'INSERT INTO subscribers ( firstname, lastname , email , password, coach, activation_code , bank_information , coach_document) VALUES ( :val1 , :val2 , :val3 , :val4 , :val5,:val6,:val7 , :val8)';
      $req = $bdd->prepare($q);
      $req->execute(
          [
              "val1" => $firstname,
              "val2" => $lastname,
              "val3" => $email,
              "val4" => $password,
              "val5" => $coach,
              "val6" => $activation_code,
              "val7" => $bank_information,
              "val8" => $filename

          ]
      );



    header('location: ../signup.php?confirm=Merci de votre inscription en tant que coach');

  }
  else
  {
    $coach = 0;
    if(!ctype_digit($_POST['code1']) || strlen($_POST['code1']) != 16  )
        {
          header('location: ../signup.php?msg=code 1 CB invalide');
          exit;
        }

    if(!ctype_digit($_POST['code2']) || strlen($_POST['code2']) != 3  )
        {
          header('location: ../signup.php?msg=code 2 CB invalide');
          exit;
        }


    if( strtotime($_POST['code3']) < strtotime(date("Y-m-d")) )
        {
          header('location: ../signup.php?msg=code CB date invalide');
          exit;
        }

    $bank_information = $_POST['code1'] . "_" . $_POST['code2'] . "_" . $_POST['code3'];
    $bank_information = hash('sha256' , $bank_information );
    $filename = 0;

      $firstname = htmlspecialchars($_POST['firstname']);
      $lastname = htmlspecialchars($_POST['lastname']);
      $email = $_POST['email'];
      $activation_code = md5(rand());
      $password = hash('sha256' , $_POST['password']); // hachage mdp

      $q = 'INSERT INTO subscribers ( firstname, lastname , email , password, coach, activation_code , bank_information , coach_document) VALUES ( :val1 , :val2 , :val3 , :val4 , :val5,:val6,:val7 , :val8)';
      $req = $bdd->prepare($q);
      $req->execute(
          [
              "val1" => $firstname,
              "val2" => $lastname,
              "val3" => $email,
              "val4" => $password,
              "val5" => $coach,
              "val6" => $activation_code,
              "val7" => $bank_information,
              "val8" => $filename

          ]
      );


      if(isset($req))
      {
          //envoie de mail
          $to = $email;
          $subject = "Verification d'email";
          $message = "<a href='https://prtfitness.tk/verify.php?activation_code=$activation_code'>Activer votre compte</a>";
          $headers = "From: PRT Fitness <prtfitness@vps781082.ovh.net>" . "\r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

          mail($to,$subject,$message,$headers);

          header('location: ../signup.php?confirm=Merci de votre inscription un mail a été envoyé');

      }
      else
      {
          header('location: ../signup.php?msg=Mail non envoyé');
      }
  }

?>
