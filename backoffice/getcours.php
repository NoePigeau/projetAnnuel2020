<?php
require('../config.php');

$r = $_GET['r'];

$q = 'SELECT id,type_training, date_cours, hours ,durée , salle FROM cours ORDER BY date_cours DESC';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>
        <tr>
            <th>type de cours</th>
            <th>date</th>
            <th>heure</th>
            <th>durée</th>
            <th>salle</th>
            <th>actions</th>
        </tr>
";

if ($r !== "") {
    $r = strtolower($r);
    $len = strlen($r);
    foreach ($results as $key => $value) {
        if (stristr($r, substr($value['type_training'], 0, $len)) || stristr($r, substr($value['date_cours'], 0, $len)) || stristr($r, substr($value['salle'], 0, $len))) {
            echo "<tr>";
            echo "<td>" . $value['type_training'] . "</td>";
            echo "<td>" . $value['date_cours'] . "</td>";
            echo "<td>" . $value['hours'] . "</td>";
            echo "<td>" . $value['durée'] . "</td>";
            echo "<td>" . $value['salle'] . "</td>";
            echo "<td>";
            echo '<button onclick="delete_training('. $value['id'] . ')" title="Supprimer" class="icons" ><span class="fas fa-trash" ></span></button>';
            echo "</td>";
            echo "</tr>";
        }
    }
}else{

    foreach ($results as $key => $value) {

        echo "<tr>";
        echo "<td>" . $value['type_training'] . "</td>";
        echo "<td>" . $value['date_cours'] . "</td>";
        echo "<td>" . $value['hours'] . "</td>";
        echo "<td>" . $value['durée'] . "</td>";
        echo "<td>" . $value['salle'] . "</td>";
        echo "<td>";
        echo '<button onclick="delete_training('. $value['id'] . ')" title="Supprimer" class="icons" ><span class="fas fa-trash" ></span></button>';
        echo "</td>";
        echo "</tr>";
    }
}

echo "</table>";

?>
