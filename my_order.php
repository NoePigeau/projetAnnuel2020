<?php session_start();
require('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Mes commandes - PRT Cardio Fitness </title>
</head>

<body>

	<?php require('header.php');

  $q ='SELECT id FROM subscribers WHERE email=?';
  $req = $bdd->prepare($q);
  $req->execute([$_SESSION['email']]);
  $id_sub = $req->fetch();

  $q='SELECT id, name, address, date_commande, stock, id_subscribers FROM commande WHERE id_subscribers=? ORDER BY date_commande DESC';
  $req = $bdd->prepare($q);
  $req->execute([$id_sub['id']]);
  $all_orders = $req->fetchAll();



	?>

	<main>
    <div  class="col-8 mx-auto tab">
      <div  class="d-flex flex-column text-white">



       <?php
       if(count($all_orders) == 0 ){

         echo '<h1> Aucune commande effectuer </h1>' ;
       }
      foreach ($all_orders as $key => $value) {

        $q='SELECT name, image, price FROM stock WHERE id=?';
        $req = $bdd->prepare($q);
        $req->execute([$value['stock']]);
        $stock = $req->fetch();
     ?>
     <div class="d-flex justify-content-around bd-highlight mb-1 p-5 m-2 border border-white">

       <div class="d-flex flex-column">

         <p > numero commande :  <?php echo $value['id']; ?> </p>

         <p>  NOM du receptionneur : <?php echo $value['name']; ?> </p>
         <br>
         <p> adresse de livraison: <?php echo $value['address']; ?> </p>
         <br>
         <p> date de la commande: <?php echo $value['date_commande']; ?> </p>
          <form action="process/delete_order?id=<?php echo $value['id']; ?>&stock=<?php echo $value['stock'];?>" method="post" enctype="multipart/form-data">
          <input class="input" type="submit" name="submit" value="Annuler la commande">
          </form>
      </div>

      <div class="d-flex flex-column">

       <h2 > <?php echo $stock['name']; ?> </h2>
       <img height = "200px" width="200px" src= "backoffice/<?php echo $stock['image']; ?>" ></img>
       <br>
       <br>
       <h3>  prix : <?php echo $stock['price']; ?> €</h3>

      </div>


     </div>

     <?php } ?>
     </div>
   </div>
   <script src="javascript/stock_shop.js">
	</main>

	<footer>

		<?php require('footer.php'); ?>

	</footer>

</body>

</html>
