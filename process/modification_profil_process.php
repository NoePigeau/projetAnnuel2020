<?php
session_start();
require('../config.php');



if($_POST['type_information'] == 0 )
{

  if(strlen($_POST['information']) < 3 || strlen($_POST['information']) > 25)
  {
      echo 'nom invalide';
      exit;
  }

  $lastname = htmlspecialchars($_POST['information']);

  $q = 'UPDATE subscribers SET lastname = ? WHERE email = ? LIMIT 1' ;
  $req = $bdd->prepare($q);
  $req->execute([	$lastname , $_SESSION['email'] ]);

echo 'nom modifié';
  exit;

}


if($_POST['type_information'] == 1)
{

  if(strlen($_POST['information']) < 3 || strlen($_POST['information']) > 20)
  {
     echo 'prenom invalide';
      exit;
  }

  $firstname = htmlspecialchars($_POST['information']);

  $q = "UPDATE subscribers SET firstname = ? WHERE email = ?" ;
  $req = $bdd->prepare($q);
  $req->execute([	$firstname , $_SESSION['email'] ]);

  echo 'prenom modifié';
  exit;

}

if($_POST['type_information'] == 2)
{
  if( !filter_var($_POST['information'] , FILTER_VALIDATE_EMAIL))
	{
			echo 'email invalide';
			exit;
	}

  $q = 'SELECT id FROM subscribers WHERE email = ?';
  $req = $bdd->prepare($q);
  $req->execute([$_POST['information']]);
  $results = $req->FetchAll();

  if(count($results) > 0)
  {
      echo 'email deja pris';
      exit;
  }

  $email =  htmlspecialchars($_POST['information']);

  $q = 'UPDATE subscribers SET email = ? WHERE email = ?' ;
  $req = $bdd->prepare($q);
  $req->execute([	$email , $_SESSION['email'] ]);

  echo 'email modifié';
  exit;
}

if($_POST['type_information'] == 3)
{

  if(strlen($_POST['information']) < 8 || !preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\d).*$/',$_POST['information']))
	{
			echo 'mot de passe minimum 8 caractère avec un majuscule et un chiffre';
			exit;
	}

  $password = hash('sha256' , $_POST['information']);

  $q = 'UPDATE subscribers SET password = ? WHERE email = ?' ;
  $req = $bdd->prepare($q);
  $req->execute([	$password , $_SESSION['email'] ]);

  echo 'mot de pass modifié';
  exit;

}



?>
