<?php
require('../config.php');

$r = $_GET['r'];

$q = 'SELECT id,firstname,lastname,email,coach,admin FROM subscribers ORDER BY id';
    $req = $bdd->query($q);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>
        <tr>
            <th>prénom</th>
            <th>nom</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
";

if ($r !== "") {
    $r = strtolower($r);
    $len = strlen($r);
    
    foreach ($results as $key => $value) {
        if (stristr($r, substr($value['firstname'], 0, $len)) || stristr($r, substr($value['lastname'], 0, $len)) || stristr($r, substr($value['email'], 0, $len))) {
            echo "<tr>";
            echo "<td>" . $value['firstname'] . "</td>";
            echo "<td>" . $value['lastname'] . "</td>";
            echo "<td>" . $value['email'] . "</td>";
            echo "<td>";
            if ($value['coach'] == 1) {
                echo 'coach';
            }
            if ($value['admin'] == 1) {
                echo 'admin';
            }
            if ($value['admin'] == 0 && $value['coach'] == 0) {
                echo 'client';
            }
            echo "</td>";
            echo "<td>";
            echo '<a onclick="delete_users('. $value['id'] . ')" title="Supprimer" class="icons"><span class="fas fa-trash"></span></a>';
            echo "</td>";
            echo "</tr>";
        }
    }
}else{
   
    foreach ($results as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value['firstname'] . "</td>";
        echo "<td>" . $value['lastname'] . "</td>";
        echo "<td>" . $value['email'] . "</td>";
        echo "<td>";
        if ($value['coach'] == 1) {
            echo 'coach';
        }
        if ($value['admin'] == 1) {
            echo 'admin';
        }
        if ($value['admin'] == 0 && $value['coach'] == 0) {
            echo 'client';
        }
        echo "</td>";
        echo "<td>";
        echo '<a onclick="delete_users('. $value['id'] . ')" title="Supprimer" class="icons"><span class="fas fa-trash"></span></a>';
        echo "</td>";
        echo "</tr>";
    }
}

echo "</table>";

?>
