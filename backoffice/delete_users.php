<?php

if(isset($_GET['id']))  {
require('../config.php');

    $q='DELETE FROM subscribers WHERE id = ?';
    $req = $bdd -> prepare($q);
    $req->execute([$_GET['id']]);
  }

 ?>
