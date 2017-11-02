<?php
include 'bdd/connexion.php';
$Composants = $_POST['composant'];
$query = "SELECT recettes.id, titre FROM recettes, composants WHERE composants.id_recette = recettes.id AND composants = :composants";
$statement = $objPDO->prepare($query);
$statement->bindParam(':composants', $Composants, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetchAll();
echo json_encode($result);
?>


