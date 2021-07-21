<?php
session_start();

require('config.php');

$q = 'SELECT id FROM subscribers WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['email']]);
$results = $req->fetchAll();
$id_subscribers = $results[0][0] ;

$q = 'SELECT entry FROM subscribers_cours WHERE id_subscribers = ? AND id_cours = ?';
$req = $bdd->prepare($q);
$req->execute([$id_subscribers ,$_POST['id_cours'] ]);
$entry = $req->fetchAll();


if(count($entry) == 0){

  $q = 'INSERT INTO subscribers_cours(id_subscribers,id_cours) VALUES (?,?)';
  $req = $bdd->prepare($q);
  $req->execute([$id_subscribers , $_POST['id_cours'] ]);

  $q = 'SELECT entry FROM subscribers_cours WHERE id_subscribers = ? AND id_cours = ?';
  $req = $bdd->prepare($q);
  $req->execute([$id_subscribers ,$_POST['id_cours'] ]);
  $entry = $req->fetchAll();

}


if(!isset($_POST['default']) ){

    if($entry[0][0] == 0){

      $q = 'UPDATE subscribers_cours SET entry = 1 WHERE id_subscribers = ? AND id_cours = ? ';
      $req = $bdd->prepare($q);
      $req->execute([$id_subscribers , $_POST['id_cours']]);

      $q = 'UPDATE cours SET number_of_entry = number_of_entry + 1 WHERE id = ? ';
      $req = $bdd->prepare($q);
      $req->execute([$_POST['id_cours']]);



    }else{

      $q = 'UPDATE subscribers_cours SET entry = 0  WHERE id_subscribers = ? AND id_cours = ?';
      $req = $bdd->prepare($q);
      $req->execute([$id_subscribers , $_POST['id_cours']]);

      $q = 'UPDATE cours SET number_of_entry = number_of_entry - 1 WHERE id = ? ';
      $req = $bdd->prepare($q);
      $req->execute([$_POST['id_cours']]);

    }


}

$q = 'SELECT number_of_entry FROM cours WHERE id = ? ';
$req = $bdd->prepare($q);
$req->execute([$_POST['id_cours']]);
$number_of_entry = $req -> fetchAll();

if($number_of_entry[0][0] > 15 && $entry[0][0] == 0){


  echo 'complet';

}
else{

  echo $entry[0][0];

}
