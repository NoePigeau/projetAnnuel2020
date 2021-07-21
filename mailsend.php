<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mail envoyé</title>
		<meta charset="utf-8">
		<meta name="description" content="Accueil">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700">
        <link rel="stylesheet" type ="text/css" href="styles.css">
		<link rel="shortcut icon" href="Images/logo.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="wrap">
			<?php include("header.php"); ?>		    
            <header class="masthead text-white text-center">
		        <div class="row">
			        <div class="col-xl-9 mx-auto">
                         <h1 class="mb-5">Merci de vous êtes inscrit, nous vous avons envoyé un mail pour confirmer la création du compte.</h1>
                    </div>
		        </div>
	        </header>
        </div>
	</body>
</html>
