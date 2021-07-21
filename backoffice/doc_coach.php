<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>back office</title>
    <meta charset="utf-8">
    <meta name="description" content="Accueil">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
  require('../config.php');
  require('header_backoffice.php');

  $q = 'SELECT id,firstname , lastname , email , coach_document FROM subscribers WHERE coach = 2';
  $req = $bdd->query($q);
  $results = $req->fetchAll();
  ?>
  <div class="wrap">
    <div class="col-9 mx-auto">
      <div id="table">
        <br><br>
        <?php if(count($results)==0){
          echo '<h2 class="text-white"> aucune demande de coach actuellement </h2>';
        }
        else {
         ?>
          <table class="table">
              <tr>
                  <th>prénom</th>
                  <th>nom</th>
                  <th>email</th>
                  <th>document</th>
                  <th>Actions</th>
              </tr>
              <?php foreach ($results as $key => $value) { ?>
                  <tr>

                      <td><?php echo $value['firstname']; ?></td>
                      <td><?php echo $value['lastname']; ?></td>
                      <td><?php echo $value['email']; ?></td>
                      <td><a href ="../coach_document/<?php echo $value['coach_document']; ?>" download="<?php echo $value['coach_document']; ?>" >télécharger</td>
                      <td>
                        <button onclick="validated(this.id)" id="<?php echo $value['id']; ?>"> acceptez </button>
                        <button onclick="not_validated(this.id)" id="<?php echo $value['id']; ?>"> refusez </button>
                      </td>



                  </tr>
              <?php } ?>
          </table>
        <?php } ?>

    </div>
  </div>
<script src="../javascript/gestion_coach_doc.js"></script>
</body>
