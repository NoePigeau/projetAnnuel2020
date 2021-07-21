<?php

if(isset($_GET['id']))  {
require('../config.php');

    $q='DELETE FROM commande WHERE id = ?';
    $req = $bdd -> prepare($q);
    $req->execute([$_GET['id']]);
  }
  
  $q='DELETE FROM commande WHERE id = ?';
  $req = $bdd -> prepare($q);
  $req->execute([$_GET['id']]);
  
  $q = 'SELECT nb_commande FROM stock WHERE id = ?';
  $req = $bdd->prepare($q);
  $req->execute([$_GET['stock']]);
  $results = $req->Fetch();
  
  $q = 'UPDATE stock SET nb_commande=?-1 WHERE id = ? '; 
  $req = $bdd->prepare($q);
  $req->execute([
  $results['nb_commande'],
  $_GET['stock']
  ]);
  
  
 header('location: ../my_order.php');
 ?>
