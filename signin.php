<?php session_start();

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion - PRT Cardio Fitness </title>
	<meta charset="utf-8">
</head>
<body>

 <div class="wrap">
	<?php require('header.php'); ?>

	<header class="masthead signin text-white text-center">
		<div class="container auth">
		<div class="row">
			<div class="col-xl-9 mx-auto">
              <h1 class="mb-5">Connexion</h1>
            </div>

			<div class="col-6 mx-auto">
  				<form  action="process/signin_process" method="post"> <!--  enlever l'extension .php pour que la connexion fonctionne  -->
  					<input type="email" class="input" name="email" placeholder="Adresse e-mail">
  					<br>
  					<input type="password" class="input" name="password" placeholder="Saisissez votre mot de passe">
  					<br>
  					<input type="submit" class="input" name="submit" value="Se connecter">
					  <?php
						if(isset($_GET['msg']))
						{
							echo '<div class="alert alert-warning">';
							echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
							echo '</div>';
						}
					 ?>
  				</form>
			</div>
		</div>
		</div>
	</header>
 </div>
 <?php require('footer.php'); ?>

</body>
</html>
