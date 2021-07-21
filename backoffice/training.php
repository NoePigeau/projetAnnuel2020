<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>back office</title>
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






    <div class="col-8 mx-auto">

        <h1 class="text-light"> Ajouter des cours </h1><br>

            <!--  enlever l'extension .php pour que la connexion fonctionne sur le site  -->
            <select id="type_cours" class=form-control>
                <option value="0">type de cours</option>
                <option value="Musculation">Musculation</option>
                <option value="Endurance">Endurance</option>
                <option value="Crossfit">Crossfit</option>
            </select>

            <input type="date" id="date" name="trip-start"
                   value="<?php echo date("Y-m-d"); ?>"
                   min="<?php echo date("Y-m-d"); ?>" max="2030-12-31">

            <select id="hours" class=form-control>
                <option value=0>heure de début</option>
                <option value=9>9h</option>
                <option value=10>10h</option>
                <option value=11>11h</option>
                <option value=12>12h</option>
                <option value=13>13h</option>
                <option value=14>14h</option>
                <option value=15>15h</option>
                <option value=16>16h</option>
                <option value=17>17h</option>
                <option value=18>18h</option>
                <option value=19>19h</option>
                <option value=20>20h</option>
                <option value=21>21h</option>
                <option value=22>22h</option>
            </select>

            <select id="time" class=form-control>
                <option value=0>durée</option>
                <option value=1>1h</option>
                <option value=2>2h</option>
                <option value=3>3h</option>
            </select>

            <select id="salle" class=form-control>
                <option value=0>choissisez une salle</option>
                <option value=1>salle 1</option>
                <option value=2>salle 2</option>
                <option value=3>salle 3</option>
            </select>



            <button onclick="add_training()" class="input" type="submit">Ajouter le cours</button>

            <br>
            <div id="msg">
            </div>



            <form class="form-inline md-form mr-auto mb-43">
                <input class="form-control mr-sm-2 my-4" type="text" onkeyup="resultat(this.value)"
                       placeholder="Rechercher un cours" aria-label="Search">
            </form>


          <div id="table">

          </div>
    </div>
</div>
<script src="../javascript/getcours.js"></script>
</body>
</html>
