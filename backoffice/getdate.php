<?php
require('../config.php');
$q = 'SELECT MONTH(date) FROM subscribers';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_COLUMN);
foreach ( $results as $value )
{
    echo  "$value ";
}
