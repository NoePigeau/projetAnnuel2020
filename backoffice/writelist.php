<?php
require('../config.php');

$r = $_GET['verif'];

$q = 'SELECT firstname,lastname,email,coach,admin FROM subscribers ORDER BY id';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

if ($r == "true") {
    $text1 = "<?xml version='1.0' encoding='utf-8' standalone='yes' ?>\r\n";
    file_put_contents('listusers.xml', $text1);
    $text = "<users>\r\n";
    file_put_contents('listusers.xml', $text, FILE_APPEND);
    foreach ($results as $key => $value) {
       $text= " <identity 
            firstname='{$value['firstname']}'
            lastname='{$value['lastname']}'
            email='{$value['email']}'/>\r\n";
        file_put_contents('listusers.xml', $text, FILE_APPEND);
    }

    $text = "</users>\r\n";
    file_put_contents('listusers.xml', $text, FILE_APPEND);
}

?>
