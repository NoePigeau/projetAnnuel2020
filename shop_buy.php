<?php
 session_start();
 require('config.php');

if(isset($_GET['id'])){
   $q = "SELECT id, name, description, image, quantities, price FROM stock WHERE id=?";
   $req = $bdd->prepare($q);
   $req->execute([$_GET['id']]);
   $results = $req->fetchAll(PDO::FETCH_ASSOC);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>La Boutique </title>
</head>
<body>


   <?php require('header.php'); ?>

	 <main>
		  <div  class="col-9 mx-auto tab">

				 <?php
         if(isset($_GET['id'])){
				foreach ($results as $key => $value) {
			 ?>
			 <div class="d-flex justify-content-around bd-highlight mb-1 p-5 m-2 text-white text-align border border-white">

         <div class="d-flex flex-column bd-highlight">

  				 <h2 > <?php echo $value['name']; ?> </h2>
  				 <img height = "300px" width="300px" src= "backoffice/<?php echo $value['image']; ?>" ></img>
  				 <p> <?php echo $value['description']; ?> </p>
  				 <br>
  				 <p> quantité: <?php echo $value['quantities']; ?> </p>
  				 <br>
  				 <h2>  <?php echo $value['price']; ?> €</h2>

         </div>
         <div class="d-flex flex-column bd-highlight">

  				 <form action="process/shop_buy_process"  method="post">
            <p> receptionneur du colis : </p>
            <input id="name" class="input" type="text" name="name" placeholder="NOM">
  					<br>
            <input id="address" class="input" type="text" name="address" placeholder="adresse postale">
 						<br>
            <p> Information bancaire : </p>
 						<input id="code1" class="input" type="number" name="code1" placeholder="XXXX XXXX XXXX XXXX">
 						<br>
   					<input id="code2" class="input" type="number" name="code2" placeholder="XXX">
   					<br>
   					<input id="code3" class="input" type="month" name="code3" min="<?php echo date("Y-m"); ?>" value="<?php echo date("Y-m-d"); ?>">
   					<br>
            <input  type="hidden" name='id' value="<?php echo $_GET['id']; ?>">

    				<input type="submit" class="input" value="acheter">
  				 </form>
           <?php
           if(isset($_GET['msg']))
           {	echo '<div class="alert alert-warning">';
             echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
             echo '</div>';
           }
            if(isset($_GET['msg2']))
           {	echo '<div class="alert alert-success">';
             echo '<h2>' . htmlspecialchars($_GET['msg2']) . '</h2>';
             echo '</div>';
           }
           ?>

         </div>


			 </div>

     <?php }}else{echo 'erreur de chargement';} ?>

		 </div>





  </main>

  <footer>
    <?php require('footer.php'); ?>

  </footer>


</body>
</html>
