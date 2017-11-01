<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "bdd/connexion.php";
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
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/scrolling-nav.css" rel="stylesheet">


</head>

<body id="page-top">
<?php
if (isset($_POST['submit'])) {

    $TabErreur = array();
    $ColorErreur = array();

    if (isset($_POST['sexe']) && (($_POST['sexe'] == 'h') || ($_POST['sexe'] == 'f'))) {

        $sexe = $_POST['sexe'];

    } else {

        $sexe = '';

    }


    if (isset($_POST['mail'])) {

        $MailTri = trim($_POST['mail']);
        $LongMail = strlen($MailTri);


        if ($LongMail > 0) {
            if (!filter_var($MailTri, FILTER_VALIDATE_EMAIL)) {

                $TabErreur[] = 'Mail';
                $ColorErreur[] = 'mail';

            } else {

                $mail = $_POST['mail'];

            }
        } else {
            $mail = '';
        }
    }

    if (isset($_POST['adresse'])) {

        $AdresseTri = trim($_POST['adresse']);
        $LongAdresse = strlen($AdresseTri);


        if ($LongAdresse > 0) {
            if ($LongAdresse < 6) {

                $TabErreur[] = 'Adresse';
                $ColorErreur[] = 'adresse';

            } else {

                $adresse = $AdresseTri;

            }
        } else {
            $adresse = '';
        }
    }

    if (isset($_POST['code_postal'])) {

        $CPTri = trim($_POST['code_postal']);
        $LongCP = strlen($CPTri);


        if ($LongCP > 0) {
            if ((!ctype_digit($_POST['code_postal'])) || ($LongCP != 5)) {

                $TabErreur[] = 'Code Postal';
                $ColorErreur[] = 'code_postal';

            } else {

                $cp = $CPTri;

            }
        } else {
            $cp = '';
        }
    }

    if (isset($_POST['ville'])) {

        $VilleTri = trim($_POST['ville']);
        $LongVille = strlen($VilleTri);


        if ($LongVille > 0) {
            if ((!ctype_alpha($_POST['ville'])) || ($LongVille < 3)) {

                $TabErreur[] = 'Ville';
                $ColorErreur[] = 'ville';

            } else {

                $ville = $VilleTri;

            }
        } else {
            $ville = '';
        }
    }

    if (isset($_POST['num_tel'])) {

        $NumTelTri = trim($_POST['num_tel']);
        $LongNumTel = strlen($NumTelTri);


        if ($LongNumTel > 0) {
            if (!ctype_digit($_POST['num_tel'])) {

                $TabErreur[] = 'Numéro Tel';
                $ColorErreur[] = 'num_tel';

            } else {

                $numTel = $NumTelTri;

            }
        } else {
            $numTel = '';
        }
    }


    if (isset($_POST['nom'])) {

        $NomTri = trim($_POST['nom']);
        $LongNomTri = strlen($NomTri);

        if ($LongNomTri > 0) {
            if (($LongNomTri <= 2) || (!ctype_alpha($_POST['nom']))) {

                $TabErreur[] = 'Nom';
                $ColorErreur[] = 'nom';

            } else {

                $nom = $_POST['nom'];

            }
        } else {
            $nom = '';
        }
    }


    if (isset($_POST['prenom'])) {

        $PrenomTri = trim($_POST['prenom']);
        $LongPreTri = strlen($PrenomTri);

        if ($LongPreTri > 0) {
            if (($LongPreTri <= 2) || (!ctype_alpha($_POST['prenom']))) {


                $TabErreur[] = 'Prenom';
                $ColorErreur[] = 'prenom';
            } else {

                $prenom = $PrenomTri;

            }
        } else {
            $prenom = '';
        }
    }

    $TabDate = explode('-', $_POST['naissance']);

    if (trim($_POST['naissance'] != '')) {


        if (!checkdate($TabDate[1], $TabDate[2], $TabDate[0])) {

            $TabErreur[] = 'Date';
            $ColorErreur[] = 'naissance';

        } else {

            $datenaiss = $_POST['naissance'];

        }
    } else {
        $datenaiss = '';
    }


    if (count($TabErreur) != 0) {

        foreach ($ColorErreur as $value2) {

            echo '<style type="text/css"> 
					.' . $value2 . '
					    {  background-color: red;
						}
						  </style>';
        }


    } else {

        echo ' Sexe : ' . $sexe . ', Nom : ' . $nom . ', Prenom : ' . $prenom . ', Date de naissance : ' . $datenaiss . ', Mail : ' . $mail . ', adresse : ' . $adresse . ', code postal : ' . $cp . ', ville : ' . $ville . ', Numero de telephone : ' . $numTel;

        if ($cp == '') {
            $objPDO->query("UPDATE inscription SET sexe='" . $sexe . "',nom='" . $nom . "',prenom='" . $prenom . "',datenaissance='" . $datenaiss . "',mail='" . $mail . "',adresse='" . $adresse . "',codepostal=0,ville='" . $ville . "',numerotel='" . $numTel . "' WHERE login ='" . $_SESSION["username"] . "'");
            header("Location: profile.php");
        } else {
            $objPDO->query("UPDATE inscription SET sexe='" . $sexe . "',nom='" . $nom . "',prenom='" . $prenom . "',datenaissance='" . $datenaiss . "',mail='" . $mail . "',adresse='" . $adresse . "',codepostal=" . $cp . ",ville='" . $ville . "',numerotel='" . $numTel . "' WHERE login ='" . $_SESSION["username"] . "'");
            header("Location: profile.php");
        }
    }
}

?>

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


$res = $objPDO->query("SELECT nom, prenom, datenaissance, mail, adresse, codepostal, ville, numerotel, sexe FROM inscription WHERE login ='" . $_SESSION["username"] . "' ");

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
            <div>
                <div>
                    <div class="modprof">
                        <form method="post" action="profileModification.php">
                            <h2>Modification de mon profil</h2>
                            <br/>
                            <label>Sexe :</label>
                            <input type="radio" name="sexe" value="f"/> une femme
                            <input type="radio" name="sexe" value="h"/> un homme
                            <br/>
                            <br/>
                            <label>Nom :</label>
                            <input type="text" name="nom" class="form-control nom"
                                   value="<?php echo $nom; ?>"/><br/>
                            <label>Prénom :</label>
                            <input type="text" class="form-control prenom" name="prenom"
                                   value="<?php echo $prenom; ?>"/><br/>
                            <label>Date de naissance :</label>
                            <input type="date" class="form-control naissance" name="naissance"
                                   value="<?php echo $datenaissance; ?>"/><br/>
                            <label>Mail :</label>
                            <input type="text" class="form-control mail" name="mail"
                                   value="<?php echo $mail; ?>"/><br/>
                            <label>Adresse :</label>
                            <input type="text" class="form-control adresse" name="adresse"
                                   value="<?php echo $adresse; ?>"/><br/>
                            <label>Code postal :</label>
                            <input type="text" class="form-control code_postal" name="code_postal"
                                   value="<?php if ($codepostal != 0) {
                                       echo $codepostal;
                                   } else {
                                       echo '';
                                   } ?>"/><br/>
                            <label>Ville :</label>
                            <input type="text" class="form-control ville" name="ville"
                                   value="<?php echo $ville; ?>"/><br/>
                            <label class="labeltel">Telephone :</label>
                            <input type="text" class="form-control num_tel" name="num_tel"
                                   value="<?php echo $numerotel; ?>"/><br/>


                            <br/>
                            <input type="submit" name="submit" class="btn btn-info" value="Mettre à jour"/>

                        </form>
                    </div>
                </div>
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


