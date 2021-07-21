<?php
session_start();
require('config.php');

$q='UPDATE subscribers SET active=0 WHERE email =?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['email']]);

header('location: signout.php');
 ?>
