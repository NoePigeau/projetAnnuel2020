<?php

require('../config.php');

if(strlen($_POST['name']) < 1 || strlen($_POST['name']) > 30)
  {
    header('location: stock_shop.php?msg=nom invalide');
    exit;
  }

//nom : test longueur
if(strlen($_POST['description']) < 2 || strlen($_POST['description']) > 220)
    {
      header('location: stock_shop.php?msg=description invalide');
      exit;
    }

if(!isset($_POST['quantities']) || $_POST['quantities'] == 0)
    {
      header('location: stock_shop.php?msg=quantité invalide');
      exit;
    }

if(!isset($_POST['price']) || $_POST['price'] == 0)
    {
      header('location: stock_shop.php?msg=prix invalide');
      exit;
    }


    $acceptable = [
		'image/jpeg',
		'image/jpg',        //liste des types autorisés
		'image/gif',
		'image/png'
	];

  	if(!in_array($_FILES['image']['type'], $acceptable)  ) // type dans le tableau ?
  	{
  		header('location: stock_shop.php?msg=le fichier n\'est pas une image');
  		exit;
  	}


      //vérification du poids du fichier

      $maxsize = 1024*1024*3; // limite du fichier à 3Mo

      if($_FILES['image']['size'] > $maxsize)
      {

          header('location:  stock_shop.php?msg=le fichier est trop volumineux ! ');
          exit;

      }

      //cherche si un dossier uploads existe, si non le crée.

      $path = 'images_shop';
      if(!file_exists($path)){
      	mkdir($path , 0777 , true);
      }

  	$filename = $_FILES['image']['name']; // le nom d'origine du fichier

  	// renommer le fichier  (evite les doublons...)
  	$temp = explode('.', $filename);
  	$extension = end($temp); // pour récupérer l'extension (png / jpeg ...)
  	$timestamp = time();
  	$filename = 'images_shop' . $timestamp . '.' . $extension; // attention ne marche pas si deux fichiers sont uploadés dans la même seconde

  	// met l'image dans un dossier avec le chemin indiqué en dessous
  	$chemin_image = $path . '/' . $filename; // Définition du chemin final
  	move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);

    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $quantities = htmlspecialchars($_POST['quantities']);
    $price = htmlspecialchars($_POST['price']);


    $q = 'INSERT INTO stock( name, description , quantities ,price , image) VALUES ( :val1 , :val2 , :val3 , :val4 , :val5)';
    $req = $bdd->prepare($q);
    $req->execute(
      [
      	"val1" => $name,
        "val2" => $description,
      	"val3" => $quantities,
        "val4" => $price,
        "val5" => $chemin_image,
      ]
    );

    header('location: stock_shop.php?msg=ajout réussi');





 ?>
