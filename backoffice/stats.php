<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>back office</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="resultat('1')">
<div class="wrap">
    <?php
    require('../config.php');
    require('header_backoffice.php');
    ?>

    <div class="col-6 mx-auto tab">
        <h1 class="text-light">Nouveaux inscrits par mois</h1><br>
        <canvas class="mx-auto" id="canvas2" width="700" height="400"></canvas>
        <div class="form-group">
            <select class="form-control" onchange="resultat(this.value)">
                <option value="1">Par Mois</option>
                <option value="2">Par Année</option>
            </select>
        </div>
    </div>
    <script src="../javascript/graph.js"></script>
</div>
</body>
</html>
