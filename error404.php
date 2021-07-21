<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil - PRT Cardio Fitness </title>
    <meta charset="utf-8">
    <meta name="description" content="Accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="wrap">
    <?php
    include('header.php');
    require('config.php');
    ?>
    <br><br><br>
    <div class="col-6 mx-auto text-light">

        <h1 class="text-center font-weight-bold"> Erreur 404</h1>
        <p class="text-center">Aucun document n'a été trouvé (lien périmé, supprimé ou erreur de saisie). </p>
        <img class="mx-auto d-block img-fluid" src="images/LogoSite.png"/>

    </div>

    <?php include("footer.php"); ?>
</body>
</html>
