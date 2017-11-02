<?php
session_start();
include 'getAliment.php';
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

    <!-- Bootstrap core JavaScript -->
    <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="bootstrap/vendor/popper/popper.min.js"></script>
    <script src="bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="bootstrap/vendor/jquery-easing/jquery.easing.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="bootstrap/js/scrolling-nav.js"></script>

    <!-- AJAX -->


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

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ol id="ariane" class="breadcrumb">
                    <li id="" class="breadcrumb-item">Aliment</li>
                </ol>
                <div id="dvTable" class="container">

                    <script>

                        function tableau(array) {

                            function ajaxAliment(values) {
                                $.ajax({
                                    url: "getAliment.php",
                                    type: "post",
                                    dataType: 'json',
                                    data: {values: values},
                                    success: function (data) {
                                        array = data;
                                        console.log(array);
                                        if (array.length <= 0) {
                                            console.log('null');
                                        } else {
                                            tableau(array);
                                        }

                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }

                                });
                            }

                            function ajaxRecette(composant) {
                                $.ajax({
                                    url: "getRecette.php",
                                    type: "post",
                                    dataType: 'json',
                                    data: {composant: composant},
                                    success: function (data) {
                                        var recettesArray = data;
                                        console.log(recettesArray);
                                        if(recettesArray.length<=0){
                                            $("#recettes").empty();
                                        }else
                                        {
                                            $("#recettes").empty();
                                            for (var i = 0; i < recettesArray.length; i++) {
                                                var li = document.createElement("LI")
                                                var a = document.createElement("a");
                                                li.className = "list-group-item";
                                                a.textContent = recettesArray[i][1];
                                                a.setAttribute('href', "page.php?id="+recettesArray[i][0]);
                                                li.appendChild(a);
                                                document.getElementById("recettes").appendChild(li);
                                            }
                                        }
                                        //document.getElementById("recettes").remove();




                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }

                                });
                            }

                            //Création d'une table et de ses arguments
                            var table = document.createElement("TABLE");
                            table.className = "table table-hover";
                            table.id = "table";

                            //Création de l'entête du tableau
                            var header = new Array();
                            header.push(["Composants"]);

                            //Supression de toutes les lignes
                            while (table.rows.length > 0) {
                                table.deleteRow(0);
                            }

                            //Création des lignes
                            var row = table.insertRow(-1);
                            var headerCell = document.createElement("TH");
                            headerCell.innerHTML = header[0];
                            row.appendChild(headerCell);


                            //Ajout des données dans les lignes
                            for (var i = 0; i < array.length; i++) {
                                var row = table.insertRow(-1);
                                var cell = row.insertCell(-1);
                                cell.innerHTML = array[i];
                            }

                            var dvTable = document.getElementById("dvTable");
                            dvTable.innerHTML = "";
                            dvTable.appendChild(table);

                            //Réagit quand on clique sur le fil d'ariane + appel AJAX
                            $("#ariane li").click(function () {
                                var values = this.innerHTML;
                                $(this).nextAll().remove();
                                ajaxAliment(values);
                            });

                            //Réagit quand on clique sur une ligne + appel AJAX
                            $('#table td').on('click', function () {
                                if (array.length <= 0) {
                                } else {
                                    var values = this.innerText;
                                    var li = document.createElement("LI")
                                    li.className = "breadcrumb-item";
                                    var valueLi = document.createTextNode(values);
                                    li.appendChild(valueLi);
                                    document.getElementById("ariane").appendChild(li);
                                    ajaxAliment(values);


                                }
                            });

                            $('#table td').on('mouseover', function () {
                                var composant = this.innerText;
                                ajaxRecette(composant)
                            });


                        }

                        //Passage d'une array PHP vers array JS avec encodage JSON (premier chargement de page)
                        var array = <?php echo json_encode($result, JSON_PRETTY_PRINT) ?>;


                        tableau(array);

                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container">
                    <h2>Recettes</h2>
                </br>
                    <ul id="recettes" class="list-group">

                    </ul>
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

