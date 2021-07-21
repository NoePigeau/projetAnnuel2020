<?php
 session_start();
 require('../config.php');

 if(!isset($_POST['name']) ||  $_POST['name'] == "")
   {
     header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg=NOM invalide');
     exit;
   }


if(strlen($_POST['address']) < 3 || strlen($_POST['address']) > 100)
	{
    header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg=adresse invalide');
		exit;
	}


if(!ctype_digit($_POST['code1']) || strlen($_POST['code1']) != 16  )
    {
      header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg=code 1 invalide');
      exit;
    }

if(!ctype_digit($_POST['code2']) || strlen($_POST['code2']) != 3  )
    {
      header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg=code 2 invalide');
      exit;
    }

$code3 = getdate($_POST['code3']);
$date =  getdate(date("Y-m"));
if( $code3[0] <= $date[0] )
    {
      header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg=code 3 invalide');
      exit;
    }

    if(isset($_SESSION['email'])){

        $q ='SELECT id FROM subscribers WHERE email=?';
        $req = $bdd->prepare($q);
        $req->execute([$_SESSION['email']]);
        $id_sub = $req->fetch();

    }else{

      $id_sub = 0;
    }


    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $bank_information = htmlspecialchars($_POST['code1']) . "_" . htmlspecialchars($_POST['code2']) . "_" . htmlspecialchars($_POST['code3']);
    $bank_information = hash('sha256' , $bank_information);

    $q ='INSERT INTO commande(name , address, bank_information, stock , id_subscribers) VALUES (:val1, :val2, :val3, :val4, :val5)';
    $req = $bdd->prepare($q);
    $req->execute([
      "val1" => $name,
      "val2" => $address,
      "val3" => $bank_information,
      "val4" => $_POST['id'],
      "val5" => $id_sub['id']

    ]);

    $q ="UPDATE stock SET quantities = quantities - 1 , nb_commande = nb_commande + 1 WHERE id=?";
    $req = $bdd->prepare($q);
    $req->execute([$_POST['id']]);




  header('location: ../shop_buy.php?id=' . $_POST['id'] . '&msg2= merci pour votre commande');
?>
