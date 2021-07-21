<!-- Haut de la page -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet" type="text/css" href="styles.css">
<link href="fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="images/favicon.ico">

<nav class="navbar navbar-expand-lg header fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/icone2.png" height="70" alt="">
            <small class="d-lg-none d-xl-inline">PRT Cardio Fitness</small>
        </a>

        <button class="navbar-toggler btn btn-link navbar-dark" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto topbar">
                <li class="nav-item mx-1">
                    <a class="nav-link" href="localisation_club.php">Le Club</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="activity.php">Activités</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="post.php">Actualités</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="shop.php">La Boutique</a>
                </li>
                <?php

                if (isset($_SESSION['coach'])) {
                    echo '	<li class="nav-item mx-1">
								<a class="nav-link" href="publication_post.php">Créer un post</a>
							</li>';
                }
                ?>
            </ul>




            <?php


            if (isset($_SESSION['admin'])) {
                echo '<li class="nav-item dropdown text-light">
							<a class="nav-link dropdown-toggle mr-3 mr-lg-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="caret"></span>';
                echo '  admin';
                echo ' </a>
						    <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						    <a class="dropdown-item" href="backoffice/backoffice.php">gestion Admin</a>
						    <a class="dropdown-item" href="signout.php">se déconnecter</a>
                		    </div>
                            </li>';
            }
            if (isset($_SESSION['email'])) {
                echo '<li class="nav-item dropdown text-light">
						<a class="nav-link dropdown-toggle mr-3 mr-lg-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i><span class="caret"></span>';
                echo '  ' . $_SESSION['email'];
                echo '</a>
						<div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="gestion_profil.php">Gestion de mon profil</a>
            <a class="dropdown-item" href="my_order.php">Mes commandes</a>
						<a class="dropdown-item" href="signout.php">Se déconnecter</a>
                		</div>
                        </li>';

            }

            if (!isset($_SESSION['email']) && !isset($_SESSION['admin'])) {
                echo '
						<ul class="nav navbar-nav">
						 <li class="nav-item text-center" id="signup-btn">
							<a href="signup.php" class="nav-link"  ><span class="fa fa-user"></span><span class="d-none d-sm-inline d-xl-block px-1">S\'inscrire</span></a>
						 </li>
						 <li class="nav-item text-center" id="login-btn">
							<a href="signin.php" class="nav-link"  ><span class="fas fa-sign-in-alt"></span><span class="d-none d-sm-inline d-xl-block px-1">Connexion</span></a>
						 </li>
						</ul>';

            }
            ?>

        </div>
    </div>
</nav>
