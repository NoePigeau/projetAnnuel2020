<?php
session_start();
require('config.php');

$q = 'SELECT id, UPPER(name)as name, description, image, quantities, price FROM stock';
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>La Boutique - PRT Cardio Fitness </title>
</head>
<body>

<?php require('header.php'); ?>

<main>
    <div class="wrap">
        <div class="col-8 mx-auto tab">
            <div class="row">
                <?php
                foreach ($results as $key => $value) {
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                       <div class="card h-100">
                        <h2 class="text-center"> <?php echo $value['name']; ?> </h2>
                        <div class="mx-auto">
                        <img height="200px" width="200px" src="backoffice/<?php echo $value['image']; ?>">
                        </div>
                        <div class="card-body">
                        <p> <?php echo $value['description']; ?> </p>
                        <p> quantité: <?php echo $value['quantities']; ?> </p>
                        
                        <h3>  <?php echo $value['price']; ?> €</h3>
                        </div>
                        <div class="card-footer">
                        <form action="shop_buy.php?id=<?php echo $value['id']; ?>" method="post">
                            <input type="submit" value="Acheter">
                        </form>
                        </div>
                       </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</main>

<footer>
    <?php require('footer.php'); ?>
</footer>


</body>
</html>
