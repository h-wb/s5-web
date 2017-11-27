<?php
session_start();
include 'bdd/connexion.php';

$res = $objPDO->query("SELECT * FROM recettes WHERE id=".$_GET['id']);
$res->execute();

$result = $res->fetch();

foreach($result as $key => $result2){
    if($key === 'titre'){
        $titre = $result2;
    }else if($key === 'ingredients'){
        $ingredients = $result2;
        $ingredient = explode("|", $result2);
    }else if($key === 'preparation'){
        if($titre != 'Hulk ( cocktail )') {
            $preparation = $result2;
            $preparation = explode(".", $result2);
        }else{
            $preparation = $result2;
        }
    }
}

if(isset($_POST['submit'])){
    if($_SESSION){
        ?>
<script type='text/javascript'>
    alert("Recette ajoutée aux favoris !");
</script>
<?php
        $objPDO->query("INSERT INTO favoris(login, idfav) VALUES ('".$_SESSION['username']."',".$_GET['id'].")");
    }else{
        header("Location: login.php");
    }
}

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Recettes</title>

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

                    <div>

                        <?php

                        $res5 = $objPDO->prepare("SELECT * FROM recettes WHERE id=".$_GET['id']);
                        $res5->execute();

                        $result5 = $res5->fetch();

                        foreach ($result as $key => $result2){
                            if($key === 'photos') {
                                if($result2 != ''){
                                    echo "<div class='test1'><img src='photos/".$result2."'></div>";
                                }
                            }
                        }

                        echo '<h2 class="centre">'.utf8_encode($titre).'</h2></br></br></br>';
                        echo '<u><h3 class = "centre">Ingrédients</h3></u></br>';
                        foreach($ingredient as $key2 => $ingredient2){
                            echo '<p class = "centre"> - '.utf8_encode($ingredient2).'</p>';
                        }
                        echo '</br></br><u><h3 class="centre">Preparation</h3></u></br>';

                        if($titre != 'Hulk ( cocktail )') {
                            foreach ($preparation as $key3 => $preparation2) {
                                echo '<p class = "centre">- ' . utf8_encode($preparation2 ). '</p>';
                            }
                        }else{
                            echo '<p class = "centre">- ' . $preparation . '</p>';
                        }


                        $resfinal = 0;

                        if($_SESSION) {
                            $res = $objPDO->prepare("SELECT count(*) From favoris where idfav=" . $_GET['id'] . " AND login='" . $_SESSION['username'] . "'");
                            $res->execute();

                            $result = $res->fetch();
                            foreach ($result as $key5 => $resultat2) {
                                if ($key5 === 0) {
                                    $resfinal = $resultat2;
                                }
                            }
                        }

                        if($resfinal == 0) {
                            ?>
                            <form method="post" action="#">
                                <input type="submit" name="submit" class="btn btn-info centrebouton"
                                       value="Ajouter la recette aux favoris"/>
                            </form>
                            <?php
                        }else{
                            echo '</br><b>Recette déjà ajoutée dans les favoris</b>';
                        }

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bottomrecette bg-dark">
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

