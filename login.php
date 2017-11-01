<?php
include 'inscriptionVerification.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/scrolling-nav.css" rel="stylesheet">


    <!-- Bootstrap core JavaScript -->
    <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="bootstrap/vendor/popper/popper.min.js"></script>
    <script src="bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="bootstrap/js/scrolling-nav.js"></script>



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
            </ul>';
                }
                else {
                    echo' <ul class="navbar-nav ml-auto" >
       
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

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <legend><h5>Inscription</h5></legend>
                    <label>Pseudonyme</label>
                    <input type="text" name="login" class="form-control login" required="required"
                           value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>"/><br/>
                    <label>Mot de passe</label>
                    <input type="password" name="mdp" class="form-control mdp" required="required"/><br/>
                    <input type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" value="Informations
                        suplémentaires"/>
                    <input type="submit" name="submit" class="btn btn-info" value="Inscription"/>
                    <div id="demo" class="collapse">
                        </br>
                        <label>Vous êtes :</label>
                        <label class="checkbox-inline"><input type="checkbox" value="f">Femme</label>
                        <label class="checkbox-inline"><input type="checkbox" value="h">Homme</label>
                        </br>
                        <label>Nom :</label>
                        <input type="text" name="form-control" class="form-control nom"
                               value="<?php if (isset($_POST['nom'])) echo $_POST['nom']; ?>"/><br/>
                        <label>Prénom</label>
                        <input type="text" class="form-control prenom" name="prenom"
                               value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom']; ?>"/><br/>
                        <label>Date de naissance</label>
                        <input type="date" class="form-control naissance" name="naissance"
                               value="<?php if (isset($_POST['naissance'])) echo $_POST['naissance']; ?>"/><br/>
                        <label>Mail</label>
                        <input type="text" class="form-control mail" name="mail"
                               value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>"/><br/>
                        <label>Adresse</label>
                        <input type="text" class="form-control adresse" name="adresse"
                               value="<?php if (isset($_POST['adresse'])) echo $_POST['adresse']; ?>"/><br/>
                        <label>Code postal</label>
                        <input type="text" class="form-control code_postal" name="code_postal"
                               value="<?php if (isset($_POST['code_postal'])) echo $_POST['code_postal']; ?>"/><br/>
                        <label>Ville</label>
                        <input type="text" class="form-control ville" name="ville"
                               value="<?php if (isset($_POST['ville'])) echo $_POST['ville']; ?>"/><br/>
                        <label class="labeltel">Telephone</label>
                        <input type="text" class="form-control num_tel" name="num_tel"
                               value="<?php if (isset($_POST['num_tel'])) echo $_POST['num_tel']; ?>"/><br/>
                        <br/>
                        <input type="submit" name="submit" class="btn btn-info" value="Inscription"/>
                    </div>
                </form>


            </div>

            <div class="col-md-6">
                <legend><h5>Connexion</h5></legend>
                <form method="post">
                <label>Pseudonyme</label>
                <input type="text" name="username" class="form-control" required/>
                <br/>
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required/>
                <br/>
                <input type="submit" name="login" class="btn btn-info" value="Se connecter"/>
                    <?php
                    if(isset($message))
                    {
                        echo '<label class="text-danger">'.$message.'</label>';
                    }
                    ?>
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

</body>

</html>
