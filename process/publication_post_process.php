<?php
session_start();
	require('../config.php');

	//verfie si il y a bien un titre et qu'il ne dépasse pas 30 char

	if(!isset($_POST['title']) || strlen($_POST['title']) > 60){
		// Redirection
		header('location: ../publication_post.php?msg=title invalide');
		exit;
	}

	// existe ? et format valide
	if(!isset($_POST['article']) ||   strlen($_POST['article']) > 600){
		// Redirection
		header('location:  ../publication_post.php?msg=text invalide');
		exit;
	}


	//vérifier le type de des fichiers envoyé.

	$acceptable = [
		'image/jpeg',
		'image/jpg',
		'image/gif',
		'image/png'
	];

	if(!in_array($_FILES['image']['type'], $acceptable) ) // type dans le tableau ?
	{
		header('location: ../publication_post.php?msg=le fichier n\'est pas une image');
		exit;
	}


    //vérification du poids du fichier

    $maxsize = 1024*1024; // limite du fichier à 1Mo

    if($_FILES['image']['size'] > $maxsize)
    {

        header('location:  ../publication_post.php?msg=le fichier est trop volumineux ! ');
        exit;

    }

    //cherche si un dossier uploads existe, si non le crée.

    $path = '../uploads';
    if(!file_exists($path)){
    	mkdir($path , 0777 , true);
    }

	$filename = $_FILES['image']['name']; // le nom d'origine du fichier

	// renommer le fichier  (evite les doublons...)
	$temp = explode('.', $filename);
	$extension = end($temp); // pour récupérer l'extension (png / jpeg ...)
	$timestamp = time();
	$filename = 'image' . $timestamp . '.' . $extension; // attention ne marche pas si deux fichiers sont uploadés dans la même seconde

	// met l'image dans un dossier avec le chemin indiqué en dessous
	$chemin_image = $path . '/' . $filename; // Définition du chemin final
	move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);

	$title = htmlspecialchars($_POST['title']);
	$article = htmlspecialchars($_POST['article']);

 $q = 'SELECT id FROM subscribers WHERE email =?';
 $req = $bdd->prepare($q);
 $req->execute([$_SESSION['email']]);
 $results = $req->fetch();

	// Requete preparée
	$q = 'INSERT INTO post(title,photo,article,id_coach) VALUES (:val1, :val2, :val3 , :val4)';
	$req = $bdd->prepare($q);
	$req->execute([
		"val1" => $title,
		"val2" => $filename,
		"val3" => $article,
		"val4" => $results['id'],
	]
	);

	// Redirection vers la liste des users
	header('location: ../post.php');
	exit;

?>
