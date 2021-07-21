<?php
session_start();

require('../config.php');


$email = htmlspecialchars($_POST['email']);
$password = hash('sha256', $_POST['password']);

  //vérification identifiants
  $q = 'SELECT id FROM subscribers WHERE email = ? AND password = ?';

   $req = $bdd->prepare($q);
   $req->execute([$email , $password]);
   $results = $req->FetchAll();

   if(count($results) == 0  ) {

   	header('location: ../signin.php?msg=Identification incorrects');
   	exit;
   }

  $q = 'SELECT active FROM subscribers WHERE email = ? AND password = ? LIMIT 1';

  $req = $bdd->prepare($q);
  $req->execute([$email , $password]);
  $results = $req->fetch();

  if($results['active'] == 1)
  {

    //test si l'utilisateur est un coach
    $q = 'SELECT coach FROM subscribers WHERE email = ? AND password = ?';

    $req = $bdd->prepare($q);
    $req->execute([$email , $password]);
    $results = $req->fetch();

    if($results['coach'] == 1  )
    {
      $_SESSION['coach'] = 1;
      $_SESSION['email'] = $email;
      header('location:../index.php');
      exit;
    }
    if($results['coach'] == 2  )
    {

      header('location: ../signin.php?msg=coach pas encore validé');
      exit;

    }

    //test si l'utilisateur est un Admin
    $q = 'SELECT admin FROM subscribers WHERE email = ? AND password = ?';

    $req = $bdd->prepare($q);
    $req->execute([$email , $password]);
    $results= $req->fetch();

    if($results['admin'] == 1 )
    {
      $_SESSION['admin'] = 1;
      header('location: ../backoffice/backoffice.php');
      exit;
    }

    //sinon utilisateur normal
    else
    {
 	    $_SESSION['email'] = $email;
       header('location: ../index.php');
       exit;
    }

  }
  else
  {
    header('location: ../signin.php?msg=Votre compte n\'est pas activé');
    exit;
  }

?>
