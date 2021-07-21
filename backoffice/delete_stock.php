<?php

if(isset($_GET['id']))  {
require('../config.php');

    $q='DELETE FROM stock WHERE id = ? AND nb_commande=0';
    $req = $bdd -> prepare($q);
    $req->execute([$_GET['id']]);
  }

 ?>
