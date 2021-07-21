<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil - PRT Cardio Fitness </title>
    <meta charset="utf-8">
    <meta name="description" content="Accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="wrap">
<img src="images/fond_index.jpg" width ="100%"/>
    <?php
     include('header.php');
     require('config.php');

     ?>
<br><br><br>
<div class="col-6 mx-auto text-light">

  <h1 class="text-center font-weight-bold"> BIENVENUE AU CLUB </h1>
  <br><br><br>


  <nav>
    <ul>
      <li> Pour nous rejoindre :  <a href="signup.php">Cliquez-ici !</a> </li>
      <li> Pour plus d'informations :  <a href="localisation_club.php">Cliquez-ici !</a> </li>
    </ul>

  </nav>
  <br><br>



  <?php
  $q ='SELECT date_cours , hours , type_training , salle FROM cours WHERE NOW() < date_cours ORDER BY date_cours LIMIT 4';
  $req = $bdd->query($q);
  $results1 = $req->fetchAll();
   ?>

  <h3>LES PROCHAINS COURS</h3>
  <div class="d-flex justify-content-start  mb-1 p-2 m-2 text-align border border-secondary">
    <?php
    foreach ($results1 as $key => $value) {
        ?>

        <div class="d-flex flex-column p-2 m-1 bg-danger mb-1">

          <p> <?php echo $value['type_training'] ?>  </p>
          <p> le : <?php echo $value['date_cours'] ?>  </p>
          <p> à : <?php echo $value['hours'] ?>h  </p>
          <p> salle : <?php echo $value['salle'] ?>  </p>

       </div>

    <?php } ?>


  </div>
  <a href="activity.php">Voir les prochains cours </a>
  <br><br>


  <?php
  $q ='SELECT lastname,firstname , title , DATE_FORMAT(date_article , "%d/%m/%y") AS date_article FROM post  LEFT JOIN subscribers ON post.id_coach = subscribers.id ORDER BY date_article DESC LIMIT 4';
  $req = $bdd->query($q);
  $results2 = $req->fetchAll();
   ?>

  <h3>LES DERNIERS POSTS</h3>
  <div class="d-flex justify-content-start  mb-1 p-2 m-2 text-align border border-secondary">
    <?php
    foreach ($results2 as $key => $value) {
        ?>

        <div class="d-flex flex-column p-2 m-1 bg-info mb-1">

          <p> <?php echo $value['title'] ?>  </p>
          <p> publié par : <?php echo $value['firstname'] ." " . $value['lastname'] ?>  </p>
          <p> le: <?php echo $value['date_article'] ?>  </p>

       </div>

    <?php } ?>


  </div>
  <a href="post.php">Voir les derniers posts </a>
  <br><br>

  <?php
  $q ='SELECT name , price , DATE_FORMAT(date_stock,"%d/%m/%y") AS date_stock FROM stock ORDER BY date_stock DESC LIMIT 3';
  $req = $bdd->query($q);
  $results3 = $req->fetchAll();
   ?>

  <h3>LES DERNIERS ARTICLES</h3>
  <div class="d-flex justify-content-start  mb-1 p-2 m-2 text-align border border-secondary">
    <?php
    foreach ($results3 as $key => $value) {
        ?>

        <div class="d-flex flex-column p-2 m-1 bg-secondary mb-1">

          <p> <?php echo $value['name'] ?>  </p>
          <p> prix : <?php echo $value['price'] ?> €  </p>
          <p> le: <?php echo $value['date_stock'] ?>  </p>

       </div>

    <?php } ?>


  </div>
  <a href="shop.php">Voir les derniers articles </a>
  <br><br>
</div>

  <div class="col-1 mx-auto text-light">
      <div id="sct"> .. </div>

      <br><br><br>

      <div id="quizz"></div>
  </div>
<?php include("footer.php"); ?>
<script src="javascript/secret_part.js">

</script>
</body>
</html>
