<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>back office</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        <a id="download" href="listusers.xml" onclick="return downloadFile()" download="listusers.xml" target="_blank" class="btn btn-secondary">Download</a>
        <br><br>
        <input id="email" placeholder="saisir une adresse mail">
        <button onclick="send_list()" class="input" type="submit">Envoyer</button>
        <div id="msg">
         <h3 id="msg2"> </h3>
        </div>
    </div>
</div>
<script src="../javascript/getuser.js">

</script>
</body>
</html>
