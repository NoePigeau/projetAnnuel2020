<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
      <title>back office</title>
      <meta charset="utf-8">
      <meta name="description" content="Accueil">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body onload="resultat('')">
    <div class="wrap">

        <?php
        require('../config.php');
        require('header_backoffice.php');
        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'] || $_SESSION['admin'] != 1)) {
            header('location:../index.php');
            exit;
        }
        ?>

        <div class="col-6 mx-auto">

            <h1 class="text-light"> Ajouter des articles </h1><br>

            <form action="add_stock_shop" method="post" enctype="multipart/form-data">

              <input class="input form-control" type="text" name="name" placeholder="nom">
              <br>
              <textarea class="input form-control" type="text" name="description" placeholder="description"></textarea>
              <br>
              <input class="input form-control" type="file" name="image">
              <br>
              <input class="input form-control" type="number" name="quantities" placeholder="quantité">
              <br>
              <input class="input form-control" type="number" name="price" placeholder="prix">
              <br>
              <input class="input" type="submit" name="submit" value="Ajouter article">

                <br>
                <?php
                if (isset($_GET['msg'])) {
                    echo '<div class="alert alert-warning">';
                    echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
                    echo '</div>';
                }
                ?>
            </form>
            <form class="form-inline md-form mr-auto mb-43">
                <input class="form-control mr-sm-2 my-4" type="text" onkeyup="resultat(this.value)"
                       placeholder="Rechercher un article" aria-label="Search">
            </form>


          <div id="table">

          </div>
          <br><br><br>

    </div>
  </div>

 <script src="../javascript/stock_shop.js">

 </script>
  </body>

</html>
