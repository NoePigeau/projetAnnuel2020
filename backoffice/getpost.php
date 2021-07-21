<?php
require('../config.php');

$r = $_GET['r'];

$q ='SELECT post.id AS id,lastname,firstname , title , DATE_FORMAT(date_article , "%d/%m/%y") AS date_article FROM post  LEFT JOIN subscribers ON post.id_coach = subscribers.id ORDER BY date_article DESC';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>
        <tr>
            <th>titre</th>
            <th>nom</th>
            <th>prénom</th>
            <th>date de publication</th>
            <th>Supprimer</th>
        </tr>
";

if ($r !== "") {
    $r = strtolower($r);
    $len = strlen($r);
    foreach ($results as $key => $value) {
        if (stristr($r, substr($value['firstname'], 0, $len)) || stristr($r, substr($value['lastname'], 0, $len)) || stristr($r, substr($value['title'], 0, $len))) {
            echo "<tr>";
            echo "<td>" . $value['title'] . "</td>";
            echo "<td>" . $value['firstname'] . "</td>";
            echo "<td>" . $value['lastname'] . "</td>";
            echo "<td>" . $value['date_article'] . "</td>";
            echo "<td>";
            echo '<a onclick="delete_post('. $value['id'] . ')" title="Supprimer" class="icons"><span class="fas fa-trash"></span></a>';
            echo "</td>";
            echo "</tr>";
        }
    }
}else{
    foreach ($results as $key => $value) {
      echo "<tr>";
      echo "<td>" . $value['title'] . "</td>";
      echo "<td>" . $value['firstname'] . "</td>";
      echo "<td>" . $value['lastname'] . "</td>";
      echo "<td>" . $value['date_article'] . "</td>";
      echo "<td>";
      echo '<a onclick="delete_post('. $value['id'] . ')" title="Supprimer" class="icons"><span class="fas fa-trash"></span></a>';
      echo "</td>";
      echo "</tr>";
    }
}

echo "</table>";

?>
