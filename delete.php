<?php
include 'bdd/connexion.php';
session_start();

$objPDO->query("DELETE FROM favoris WHERE idfav='".$_GET['id']."'");
header("Location: favorites.php");
?>