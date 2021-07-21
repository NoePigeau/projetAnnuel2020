<?php
session_start();
require('config.php');

$q = 'SELECT id , DATE_FORMAT(date_cours , "%e/%c") AS dates , type_training , salle , hours , durée FROM cours';
$req = $bdd->query($q);
$results = $req->fetchAll();

// if($_SESSION['email'] != ""){
//
//   $q = 'SELECT id FROM subscribers WHERE email = ?';
//   $req = $bdd->prepare($q);
//   $req->execute([$_SESSION['email']]);
//   $result = $req->fetchAll();
//   $id_sub = $result[0][0] ;
//
// }


 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Les Activités - PRT Cardio Fitness </title>
</head>
<body>



<?php require('header.php'); ?>


<main>
    <div class="col-8 mx-auto tab">
    <br>
    <h1 class="text-center text-white"> LES ACTIVITÉS  </h1>
    <br>



    <div class="col-8 mx-auto tab">
        <h2> Musculation suivis par un coach </h2>
        <div class="d-flex justify-content-center">
        <div class="p-2 bd-highlight"><a href=""><img width="300px" height="200px" src="images/base-entrainement-musculation.jpg"> </a></div>
        <p class= activity>La musculation est une discipline qui vise à développer et à entretenir la masse musculaire des pratiquants par le biais d’exercices physiques. Elle permet d’accroitre le volume musculaire, la force, l’endurance, la puissance, l’explosivité et la résistance du corps. La musculation est l’élément central de plusieurs sports comme le culturisme ou l’haltérophilie par exemple. Elle constitue également une part de la préparation physique pour les athlètes, notamment de haut niveau, qui ont besoin d’une solide condition physique pour maximiser leurs performances. La musculation peut être également utilisée par des méthodes plus douces comme le fitness, le stretching ou dans le cas de soins médicaux comme la kinésithérapie ou la rééducation.
        </p>
       </div>

        <h2> cours endurance collectifs </h2>
        <div class="d-flex justify-content-center">
        <p class= activity>L’entraînement cardio vasculaire est une discipline qui permet aux pratiquants de travailler leur endurance et d’améliorer leurs performances cardiaques. Pour y parvenir, il est nécessaire de répartir l’effort physique sur la durée et d’opter pour une intensité d’exercice plutôt moyenne afin d’être capable de tenir le rythme. Tapis, vélos, elliptiques, rameurs, corde à sauter… Fitness Park met à la disposition de ses adhérents tout le matériel nécessaire pour les exercices cardio vasculaires. Le cardio training est également intéressant pour les sportifs qui sont en période de sèche ou les personnes désirant perdre du poids car il permet d’augmenter les dépenses caloriques journalières.
        </p>
        <div class="p-2 bd-highlight"><a href=""><img width="300px" height="200px" src="images/endurance.jpg"> </a></div>
        </div>

        <h2> Crossfit suivis par un coach </h2>
        <div class="d-flex justify-content-center">
          <div class="p-2 bd-highlight"><a href=""><img width="300px" height="200px" src="images/crossfit.png"> </a></div>
        <p class= activity>Le Cross training est une méthode d’entraînement et de préparation physique qui combine plusieurs éléments : force physique, endurance, gymnastique, souplesse, dextérité… Les pratiquants effectuent des mouvements olympiques d’haltérophilie en les combinant avec des exercices au poids de corps comme les dips, les tractions ou le gainage et avec des exercices de cardio comme le rameur, la course, les burpees…
        </p>
        </div>

    </div>

    </div>

<div class="col-8 mx-auto tab">

       <div class="d-flex justify-content-center tab">
        <button onclick="back()" class ="center-block btn btn-outline-secondary mx-3" id="back">arrière</button>
        <button onclick="next()" class ="center-block btn btn-outline-secondary mx-3" id="next">suivant</button>
       </div>

        <table class="table">
          <thead>
              <tr scope="row">

                <th ></th>
                <th class="day" abbr="1" >lun</th>
                <th class="day" abbr="2" >Mar</th>
                <th class="day" abbr="3" >Mer</th>
                <th class="day" abbr="4" >Jeu</th>
                <th class="day" abbr="5" >Ven</th>
                <th class="day" abbr="6" >Sam</th>
                <th class="day" abbr="7" >Dim</th>
              </tr>
          </thead>
          <tbody>
            <?php
            $hours = 9;
            $hours1 = 10;
            $hours_stacks = $hours . 'h' . "-" . $hours1 . "h" ;

            for($i=0 ; $i < 13 ; $i++ ) { ?>

             <tr scope="row" id="<?php echo $hours; ?>">
               <th>
                   <?php
                   $hours_stacks = $hours . 'h' . "-" . $hours1 . "h" ;
                   echo $hours_stacks;
                   $hours++;
                   $hours1++;
                   ?>
               </th>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>

          <?php  } ?>

          </tbody>
    </table>
</div>
<script src="javascript/calendar.js"></script>
</main>

<footer>
    <?php require('footer.php'); ?>
</footer>


<input id="session" type="hidden" value = "<?php  if(isset($_SESSION['email'])){echo '1';}  ?>">


<input id="ids" type="hidden"  value = "<?php
foreach ($results as $key => $value) {
 echo $value['id'] . " ";
}
?>">

<input id="cours" type="hidden" value = "<?php
foreach ($results as $key => $value) {
echo $value['dates'] . " ";
}
?>">

<input id="type_training" type="hidden" value = "<?php
foreach ($results as $key => $value) {
echo $value['type_training'] . " ";
}
?>">

<input id="salle" type="hidden" value = "<?php
foreach ($results as $key => $value) {
echo $value['salle'] . " ";
}
?>">

<input id="hours" type="hidden" value = "<?php
foreach ($results as $key => $value) {
echo $value['hours'] . " ";
}
?>">

<input id="durée" type="hidden" value = "<?php
foreach ($results as $key => $value) {
echo $value['durée'] . " ";
}
?>">


</body>
</html>
