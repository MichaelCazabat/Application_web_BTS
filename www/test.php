<?php 
include("connect.php");

$reference = $_POST['reference'];
$nom = $_POST['nom'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];
$description = $_POST['description'];


$req=$bdd->prepare("INSERT INTO produits SET reference = ?, nom = ?, prix = ?, quantite = ?, description = ?");
$req->execute(array($reference, $nom, $prix, $quantite, $description));

 ?>
 