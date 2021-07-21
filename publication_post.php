<?php session_start();

require('config.php');

// if(!isset($_SESSION['coach']))
// {
// 	header('location:post.php');
// 	exit;
// }

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Actualités - PRT Cardio Fitness</title>
</head>

<body>

	<?php require('header.php');
	if (!isset($_SESSION['coach']) || empty($_SESSION['coach'] || $_SESSION['coach'] != 1)) {
			header('location:index.php');
			exit;
	}

	 ?>

	<main>
   <div class="wrap">
		<br><br><br><br><br>
		<div class="col-6 mx-auto">
			<h1 class="text-light"> Créez votre propre publication </h1>
			<br>
			<?php
			if (isset($_GET['msg'])) {
			  echo '<div class="col-5 alert alert-warning">';
                        echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
                        echo '</div>';
			}
			?>
			<form action="process/publication_post_process" method="post" enctype="multipart/form-data">
				<input class="form-control" type="text" name="title" placeholder="titre">
				<div class="form-group">
					<textarea name="article" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="article ..."></textarea>
				</div>
				<input class="form-control" type="file" name="image" placeholder="photo">
				<br>
				<input class="form-control" type="submit" name="submit" placeholder="publier">
				<br>

			</form>

		</div>
    </div>
	</main>

	<footer>
		<?php require('footer.php'); ?>

	</footer>


</body>

</html>
