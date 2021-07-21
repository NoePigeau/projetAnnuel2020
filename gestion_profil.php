<?php session_start();
require('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profil - PRT Cardio Fitness </title>
</head>

<body>

	<?php require('header.php');

	$q = 'SELECT firstname,lastname,email,password FROM subscribers WHERE email = ? ';
	$req = $bdd->prepare($q);
	$req->execute([$_SESSION['email']]);
	$results = $req->fetch();

	?>

	<main>
		<header class="masthead text-white text-center">
			<div class="container auth">
				<div class="row">
					<div class="col-xl-9 mx-auto">
						<h1 class="mb-5"> Mon compte </h1>
					</div>

					<div class="col-6 mx-auto">
						<?php

						if (isset($_GET['msg'])) {
							echo '<div class="alert alert-warning">';
							echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
							echo '</div>';
						}

						?>


							<div id='div' class="d-flex flex-column bd-highlight mb-3">

									<p>Nom:<?php echo $results['lastname'] ?></p>
									<button onclick="modify_information(this.id)" id='<?php echo $results['lastname'] ?>' class="rounded-pill">modifier</button>
									<br>


									<p>Prenom:  <?php echo $results['firstname'] ?></p>
									<button onclick="modify_information(this.id)" id='<?php echo $results['firstname'] ?>' class="rounded-pill">modifier</button>
									<br>


									<p>Email:<?php echo $results['email'] ?></p>
									<button onclick="modify_information(this.id)" id='<?php echo $results['email']?>' class="rounded-pill">modifier</button>
									<br>

									<p>Mot de passe: ****** </p>
									<button onclick="modify_information(this.id)" id='<?php echo $results['password']?>' class="rounded-pill">modifier</button>

								 <br>
						  </div>
					</div>
				</div>
			</div>
      <?php if(!isset($_SESSION['coach']) || $_SESSION['coach'] != '1') {

		echo '<div class="col-6 mx-auto tab">';

		echo	"<form method='post' action='disabled_account'>";

		echo		"<h3>abonnement de 27 € par mois: </h3>";
		echo		"<input class='btn btn-secondary' type='submit' value='ANNULER ABONNEMENT'>";

  	echo		"</form>";

  	echo	"</div>";

	   } ?>
		</header>

		

	</main>

	<footer>

		<?php require('footer.php'); ?>

	</footer>
	<script src="javascript/gestion_profil.js"></script>

</body>

</html>
