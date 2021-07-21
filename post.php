<?php session_start();
require('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Actualités - PRT Cardio Fitness</title>
</head>
<body>

<?php require('header.php'); 
	if ( !isset($_SESSION['email']) && !isset($_SESSION['admin']) && !isset($_SESSION['coach']) ) {
			header('location: signin.php');
			exit;
	}
?>
<main>
    <div class="wrap">
        <br><br><br><br><br>
        <?php
        if (isset($_GET['msg'])) {
            echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
        }

        $q = 'SELECT post.id AS id,title , article , photo , DATE_FORMAT(date_article , "%d/%m/%y  %H:%i:%s") AS date_article,firstname,lastname  FROM post
			LEFT JOIN subscribers ON post.id_coach = subscribers.id ORDER BY date_article DESC';
        $req = $bdd->query($q);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class=container>
            <?php
            foreach ($results as $key => $value) {
                ?>
                <div class="p-3 mb-2 bg-light text-dark rounded">

                    <h2 class="font-weight-bold"> <?php echo $value['title']; ?> </h2>
                    <img class="rounded border" height=200px src="uploads/<?php echo $value['photo']; ?>">
                    <br>
                    <p> <?php echo $value['article']; ?> </p>
                    <h5> <?php echo 'le ' . $value['date_article'] . ' par ' . $value['firstname'] . " " . $value['lastname']; ?>  </h5>

                    <button class="likes_post" id="<?php echo $value['id']; ?>" type="checkbox" onclick="put_like(this.id); like_or_not(this.id)">Je n'aime plus</button>
                    <span id="<?php echo $value['id'];?>1" class="fa fa-thumbs-up counter">" "</span>
                </div>

            <?php } ?>

        </div>
    </div>
</main>
<script type="text/javascript" src="javascript/likes.js"></script>
<footer>
    <?php require('footer.php'); ?>
</footer>


</body>
</html>
