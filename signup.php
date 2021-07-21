<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Inscription - PRT Cardio Fitness </title>
    <link rel="stylesheet" type="text/css" href="captcha/style_canvas.css">
    <script src="captcha/recaptcha.js" type="text/javascript"></script>

</head>
<body onload="draw()">

<?php require('header.php'); ?>


<header class="masthead text-white text-center">
    <div class="container auth">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5 title">Inscription</h1>
            </div>

            <div class="col-6 mx-auto">
                <form action="process/signup_process" method="post" enctype="multipart/form-data"
                      onsubmit="return checkForm()">
                    <!--  enlever l'extension .php pour que la connexion fonctionne sur le site  -->
                    <input id="firstname" class="input" type="text" name="firstname" placeholder="Prénom">
                    <br>
                    <input id="lastname" class="input" type="text" name="lastname" placeholder="Nom">
                    <br>
                    <input id="email" class="input" type="email" name="email" placeholder="Adresse e-mail">
                    <br>
                    <input id="password" class="input" type="password" name="password" placeholder="Mot de passe">
                    <br>

                    <div class="d-flex justify-content-center">
                        <div class="radio p-2">
                            <label><input onclick="sub_or_coach()" id="sub" type="radio" name="subscrition" value='sub'
                                          checked>Abonnements</label>
                        </div>
                        <div class="radio p-2">
                            <label><input onclick="sub_or_coach()" id="coach" type="radio" name="subscrition"
                                          value='coach'>Coach</label>
                        </div>
                    </div>

                    <div id="tag_parent">


                    </div>
                    <br>
                    <canvas id="canvas" height="250" width="250"></canvas>
                    <br>
                    <input id="validator" name="validator" type="hidden"></button>
                    <br>
                    <input class="input " type="submit" name="submit" value="S'inscrire">
                    <?php
                    if (isset($_GET['msg'])) {
                        echo '<div class="alert alert-warning">';
                        echo '<h2>' . htmlspecialchars($_GET['msg']) . '</h2>';
                        echo '</div>';
                    }
                    if (isset($_GET['confirm'])) {
                        echo '<div class="alert alert-success">';
                        echo '<h2>' . htmlspecialchars($_GET['confirm']) . '</h2>';
                        echo '</div>';
                    }
                    ?>
                </form>

            </div>
        </div>
</header>

<?php require('footer.php'); ?>
<script src="javascript/setting_signup.js"></script>

</body>
</html>
