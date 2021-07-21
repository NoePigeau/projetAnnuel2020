<?php

session_start();
require('../config.php');

if($_POST['type_cours'] == '0'){
 echo 'selectionner un type de cours';
 exit;
}
$type_training = $_POST['type_cours'] ;


if(empty($_POST['date']) || strtotime($_POST['date']) < strtotime(date("Y-m-d"))){
 echo 'la date est incorrecte';
 exit;
}
$date = $_POST['date'];

if($_POST['hours'] == '0'){
 echo 'selectionner une heure';
 exit;
}
$hours = $_POST['hours'] ;

if($_POST['time'] == '0'){
 echo 'selectionner une durée';
 exit;
}
$time = $_POST['time'] ;

if($_POST['salle'] == '0'){
 echo 'selectionner une salle';
 exit;
}
$salle = $_POST['salle'] ;



$q = 'SELECT date_cours , hours , salle  FROM cours';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $key => $value) {

  if($value['date_cours'] == $date && $value['hours'] == $hours && $value['hours'] < $hours + $time ){

    echo 'un cours a deja lieu à cette heure';
    exit;

  }


}


$q = 'INSERT INTO cours ( type_training , date_cours , hours , durée , salle ) VALUES ( :val1 , :val2 , :val3 , :val4 , :val5)';
$req = $bdd->prepare($q);
$req->execute(
  [
    "val1" => $type_training,
    "val2" => $date,
    "val3" => $hours,
    "val4" => $time,
    "val5" => $salle,

  ]
);



echo 'cours ajouté';
exit;




 ?>
