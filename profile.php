<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "bdd/connexion.php";
if (!$_SESSION) {
    header("Location: index.php");
}
else{
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mon profil</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/scrolling-nav.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">CoktailDOTCom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="receipts.php">Recettes</a>
                </li>
                <?php
                if ($_SESSION) {

                    echo ' <ul class="navbar-nav ml-auto">
       
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="profile.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="logout.php">Déconnexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger">' . " " . '</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger">' . $_SESSION["username"] . '</a>
                </li>
            </ul>';
                } else {

                    echo ' <ul class="navbar-nav ml-auto" >
       
                <li class="nav-item" >
                    <a class="nav-link js-scroll-trigger" href = "login.php" > Connexion</a >
                </li >
            </ul >';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<header class="bg-primary text-white">
    <div class="container text-center">
        <h1>Recettes de Cocktail</h1>
        <p class="lead">Pour les petits et les grands !</p>
    </div>
</header>
<?php
$res = $objPDO->query("SELECT nom, prenom, datenaissance, mail, adresse, codepostal, ville, numerotel, sexe FROM inscription WHERE login = '" . $_SESSION["username"] . "'");

foreach ($res as $res2) {
    foreach ($res2 as $key => $res3) {

        if ($key == '0') {
            $nom = $res3;
        } else if ($key == '1') {
            $prenom = $res3;
        } else if ($key == '2') {
            $datenaissance = $res3;
        } else if ($key == '3') {
            $mail = $res3;
        } else if ($key == '4') {
            $adresse = $res3;
        } else if ($key == '5') {
            $codepostal = $res3;
        } else if ($key == '6') {
            $ville = $res3;
        } else if ($key == '7') {
            $numerotel = $res3;
        } else if ($key == '8') {
            $sexe = $res3;


        }

    }
}
?>
<section id="about">
    <div class="container">
            <div class="panel panel-default">
                <div class="profilbase">
                    <br method="post" action="profileModification.php">
                    <h2>Mon profil</h2>
                    </br>
                    <label> Sexe :</label>
                    <?php
                    if ($sexe == '') {
                        echo "  -";
                    } else {
                        echo $sexe;
                    } ?>
                    </br></br>
                    <label>Nom : </label><?php if ($nom == '') {
                        echo "  -";
                    } else {
                        echo $nom;
                    } ?>
                    </br></br>
                    <label>Prénom : </label><?php if ($prenom == '') {
                        echo "  -";
                    } else {
                        echo $prenom;
                    } ?>
                    </br></br>
                    <label>Date de naissance : </label><?php if ($datenaissance == '') {
                        echo "  -";
                    } else {
                        echo $datenaissance;
                    } ?>
                    </br></br>
                    <label>Mail : </label><?php if ($mail == '') {
                        echo "  -";
                    } else {
                        echo $mail;
                    } ?>
                    </br></br>
                    <label>Adresse : </label><?php if ($adresse == '') {
                        echo "  -";
                    } else {
                        echo $adresse;
                    } ?>
                    </br></br>
                    <label>Code postal : </label><?php if ($codepostal == 0) {
                        echo "  -";
                    } else {
                        echo $codepostal;
                    } ?>
                    </br></br>
                    <label>Ville : </label><?php if ($ville == '') {
                        echo "  -";
                    } else {
                        echo $ville;
                    } ?>
                    </br></br>
                    <label> Telephone :</label><?php if ($numerotel == '') {
                        echo "  -";
                    } else {
                        echo $numerotel;
                    }

                    ?>
                    </br>
                    <br/>
                    <a href="profileModification.php">Modifier mon profil</a></br></br>
                    <a href="favorites.php">Consulter mes recettes favorites</a>

                    </form>
                </div>
            </div>
    </div>

</section>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Projet Web - Anthony GENOVA & Hugo WEHBE</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="bootstrap/vendor/popper/popper.min.js"></script>
<script src="bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="bootstrap/js/scrolling-nav.js"></script>

</body>

</html>

<?php
}
?>