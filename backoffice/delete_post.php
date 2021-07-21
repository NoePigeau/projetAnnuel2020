<?php

if(isset($_GET['id']))  {
require('../config.php');

    $q='DELETE FROM post WHERE id = ?';
    $req = $bdd -> prepare($q);
    $req->execute([$_GET['id']]);
  }

 ?>
