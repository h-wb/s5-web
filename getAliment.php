
<?php
include 'bdd/connexion.php';
if (!isset($_POST['values'])) {
    $Aliment = "Aliment";
} else
    $Aliment = $_POST['values'];
//$Aliment = 'Fruit';
$query = "SELECT nom FROM super_categ WHERE super_categ = :super_categ";
$statement = $objPDO->prepare($query);
$statement->bindParam(':super_categ', $Aliment, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_COLUMN);
echo json_encode($result);
?>

