<?php
require('../config.php');

$r = $_GET['r'];

$q = 'SELECT  id,name, description, image, quantities, price, nb_commande FROM stock ORDER BY name DESC';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>
        <tr>
            <th>nom</th>
            <th>quantités</th>
            <th>prix</th>
            <th>nombre commande</th>
            <th>supprimer</th>
        </tr>
";

if ($r !== "") {
    $r = strtolower($r);
    $len = strlen($r);
    foreach ($results as $key => $value) {
        if (stristr($r, substr($value['name'], 0, $len)) ||  stristr($r, substr($value['quantities'], 0, $len))|| stristr($r, substr($value['nb_commande'], 0, $len))|| stristr($r, substr($value['price'], 0, $len))) {
            echo "<tr>";
            echo "<td>" . $value['name'] . "</td>";
            echo "<td>" . $value['quantities'] . "</td>";
            echo "<td>" . $value['price'] ."€" . "</td>" ;
            echo "<td>" . $value['nb_commande'] . "</td>";
            echo "<td>";
            echo '<button onclick="delete_stock('. $value['id'] . ')" title="Supprimer" class="icons" ><span class="fas fa-trash" ></span></button>';
            echo "</td>";
            echo "</tr>";
        }
    }
}else{

    foreach ($results as $key => $value) {

      echo "<tr>";
      echo "<td>" . $value['name'] . "</td>";
      echo "<td>" . $value['quantities'] . "</td>";
      echo "<td>" . $value['price'] ."€" ."</td>";
      echo "<td>" . $value['nb_commande'] . "</td>";
      echo "<td>";
      echo '<button onclick="delete_stock('. $value['id'] . ')" title="Supprimer" class="icons" ><span class="fas fa-trash" ></span></button>';
      echo "</td>";
      echo "</tr>";
    }
}

echo "</table>";

?>
