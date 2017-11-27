<?php
session_start();
include 'bdd/connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accueil</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
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
                    <a class="nav-link js-scroll-trigger">'." ".'</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger">'.$_SESSION["username"].'</a>
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
    <div>
        <div>
            <div class="global">

                <br>

                <h3 class="centre"><b>Sélection aléatoire de recettes</b></h3></br></br></br>
                    <?php

                    for($i=0;$i < 5; $i++) {
                        $res = $objPDO->prepare("SELECT titre From recettes where id=".rand(1,107));
                        $res->execute();

                        $result = $res->fetch();
                        foreach ($result as $key => $result2) {
                            if($key === 'titre') {
                                $res2 = $objPDO->prepare("SELECT id From recettes where titre='".$result2."'");
                                $res2->execute();

                                $result3 = $res2->fetch();
                                $id = 0;
                                foreach($result3 as $key2 => $result4){
                                    if($key2 === 'id') {
                                        $id = $result4;
                                    }
                                }
                                echo '<h4 class="centre"><a href="page.php?id='.$id.'">' .utf8_encode($result2) . '</a></h4></br></br>';
                            }
                        }

                    }
                    ?>
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

<script src="bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="bootstrap/vendor/popper/popper.min.js"></script>
<script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom JavaScript for this theme -->
<script src="bootstrap/js/scrolling-nav.js"></script>

</body>

</html>

