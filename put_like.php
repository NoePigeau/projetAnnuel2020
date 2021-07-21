<?php
session_start();

require('config.php');


$q = 'SELECT id FROM subscribers WHERE email = ? ';
$req = $bdd->prepare($q) ;
$req->execute([$_SESSION['email']]) ;
$results = $req->fetchAll() ;
$id_subscribers = $results[0][0] ;

$q = 'SELECT active FROM likes WHERE id_post=? AND id_subscribers=?';
$req = $bdd->prepare($q);
$req->execute([$_POST['id'] , $id_subscribers ]);
$likes = $req->fetchAll();


if(count($likes) == 0 ){

  $q = 'INSERT INTO likes(id_subscribers,id_post,active) VALUES (?,?,?)';
  $req = $bdd->prepare($q);
  $req->execute([$id_subscribers, $_POST['id'],0]);

  $q = 'SELECT active FROM likes WHERE id_subscribers = ? and id_post = ?';
  $req = $bdd->prepare($q);
  $req->execute([$id_post, $_POST['id']]);
  $likes = $req->fetchAll();
}


if(!isset($_POST['default'])){

  if($likes[0][0] == 0){

    $q = 'UPDATE likes SET active = 1 WHERE id_subscribers =? AND id_post=?' ;
    $req = $bdd->prepare($q);
    $req->execute([$id_subscribers, $_POST['id']]);

    $q = 'UPDATE post SET likes = likes + 1 WHERE id=?' ;
    $req = $bdd->prepare($q);
    $req->execute([$_POST['id']]);



  }else{

    $q = 'UPDATE likes SET active = 0 WHERE id_subscribers =? AND id_post=?' ;
    $req = $bdd->prepare($q);
    $req->execute([$id_subscribers, $_POST['id']]);

    $q = 'UPDATE post SET likes = likes - 1 WHERE id=?' ;
    $req = $bdd->prepare($q);
    $req->execute([$_POST['id']]);
  }








}
$q = 'SELECT likes FROM post WHERE  id = ? ';
$req = $bdd->prepare($q) ;
$req->execute([$_POST['id']]) ;
$number_of_likes = $req->fetchAll() ;

echo $number_of_likes[0][0];
echo " ";
echo $likes[0][0];














 ?>
