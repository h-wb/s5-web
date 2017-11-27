<?php

include "Donnees.inc.php";

define( 'DB_NAME', 'l3ufr' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );

try
{
	$connexion = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASSWORD);
}
catch(Exception $exception)
{
	die($exception->getMessage());
}

// création de la requête sql
// on teste avant si elle existe ou non (par sécurité)
$requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
 
// on prépare et on exécute la requête
$connexion->prepare($requete)->execute();


// connexion à la bdd
$objPDO = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

 
// on vérifie que la connexion est bonne
if($connexion){
	// on créer la requête
	$requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`recettes` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`titre` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`ingredients` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
				`preparation` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
				`photos` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
 
	// on prépare et on exécute la requête
	$connexion->prepare($requete)->execute();


	
	$requete2 = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`inscription` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`login` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`mdp` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`nom` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`prenom` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`datenaissance` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`mail` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`adresse` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`codepostal` INT DEFAULT NULL ,
				`ville` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`numerotel` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL ,
				`sexe` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL 
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";



	$connexion->prepare($requete2)->execute();

    $requete3 = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`composants` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`id_recette` INT NOT NULL ,
				`composants` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";



    $connexion->prepare($requete3)->execute();

    foreach($Recettes as $cle => $valeur){
        foreach($valeur as $cle2 => $valeur2){

            if($cle2 != 'index'){

                if($cle2 == 'titre'){
                    $titre = $valeur2;
                }else if($cle2 == 'ingredients'){
                    $ingredients = $valeur2;
                }else if($cle2 == 'preparation'){
                    $preparation = $valeur2;


                    $objPDO -> query("INSERT INTO recettes (id, titre, ingredients, preparation) VALUES ('".$cle."','".utf8_decode(addslashes($titre))."','".utf8_decode(addslashes($ingredients))."','".utf8_decode(addslashes($preparation))."')");
                }

            }else{

                foreach($valeur2 as $valeur3){

                    $objPDO->query("INSERT INTO composants (id_recette, composants) VALUES ('".$cle."','".$valeur3."')");

                }

            }

        }
    }

    $objPDO->query("UPDATE recettes SET photos='Black_velvet.jpg' WHERE titre='Black velvet'");
    $objPDO->query("UPDATE recettes SET photos='Bloody_mary.jpg' WHERE titre='Bloody mary'");
    $objPDO->query("UPDATE recettes SET photos='Bora_bora.jpg' WHERE titre='Bora bora'");
    $objPDO->query("UPDATE recettes SET photos='Builder.jpg' WHERE titre='Builder'");
    $objPDO->query("UPDATE recettes SET photos='Caipirinha.jpg' WHERE titre='Caipirinha'");
    $objPDO->query("UPDATE recettes SET photos='Coconut_kiss.jpg' WHERE titre='Coconut kiss'");
    $objPDO->query("UPDATE recettes SET photos='Cuba_libre.jpg' WHERE titre='Cuba libre'");
    $objPDO->query("UPDATE recettes SET photos='Frosty_lime.jpg' WHERE titre='Frosty lime'");
    $objPDO->query("UPDATE recettes SET photos='Le_vandetta.jpg' WHERE titre='Le vandetta'");
    $objPDO->query("UPDATE recettes SET photos='Margarita.jpg' WHERE titre='Margarita'");
    $objPDO->query("UPDATE recettes SET photos='Mojito.jpg' WHERE titre='Mojito'");
    $objPDO->query("UPDATE recettes SET photos='Pina_colada.jpg' WHERE titre='Pina colada'");
    $objPDO->query("UPDATE recettes SET photos='Raifortissimo.jpg' WHERE titre='Raifortissimo'");
    $objPDO->query("UPDATE recettes SET photos='Sangria_sans_alcool.jpg' WHERE titre='Sangria sans alcool'");
    $objPDO->query("UPDATE recettes SET photos='Screwdriver.jpg' WHERE titre='Screwdriver'");
    $objPDO->query("UPDATE recettes SET photos='Shoot_up.jpg' WHERE titre='Shoot up'");
    $objPDO->query("UPDATE recettes SET photos='Tequila_sunrise.jpg' WHERE titre='Tequila sunrise'");
    $objPDO->query("UPDATE recettes SET photos='Tipunch.jpg' WHERE id=105");


    $requete4 = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`super_categ` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`nom` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`super_categ` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";



    $connexion->prepare($requete4)->execute();

    $requete5 = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`sous_categ` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`nom` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`sous_categ` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";



    $connexion->prepare($requete5)->execute();

    foreach($Hierarchie as $cle => $valeur){
        foreach($valeur as $cle2 => $valeur2){
            foreach($valeur2 as $valeur3){

                if($cle2 == 'super-categorie'){

                    $super_categ = $valeur3;
                    $objPDO->query("INSERT INTO super_categ (nom, super_categ) VALUES ('".addslashes($cle)."', '".addslashes($super_categ)."')");

                }else if($cle2 == 'sous-categorie'){

                    $sous_categ = $valeur3;
                    $objPDO->query("INSERT INTO sous_categ (nom, sous_categ) VALUES ('".addslashes($cle)."', '".addslashes($sous_categ)."')");

                }
            }
        }
    }

    $requete5 = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`favoris` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`login` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
				`idfav` INT NOT NULL 
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

    $connexion->prepare($requete5)->execute();

    echo "<a href='/ProjetWebL3/index.php'> Accéder au site</a>";
}
?>