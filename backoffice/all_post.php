<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>les posts</title>
    <meta charset="utf-8">
    <meta name="description" content="Accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="resultat('')">
<div class="wrap">
    <?php
    require('../config.php');
    require('header_backoffice.php');

    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'] || $_SESSION['admin'] != 1)) {
        header('location:../index.php');
        exit;
    }


    ?>
    <div class="col-6 mx-auto tab">
        <form class="form-inline md-form mr-auto mb-43">
            <input class="form-control mr-sm-2 my-4" type="text" onkeyup="resultat(this.value)"
                   placeholder="Rechercher un utilisateur" aria-label="Search">
        </form>
        <div id="table">
        </div>

    </div>
</div>
<script src="../javascript/getpost.js">

</script>
</body>
</html>
