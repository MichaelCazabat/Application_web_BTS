<?php 
	include("connect.php");
	require_once("include/function.php");
 	log_only();

	$id_produits = $_GET['id']; //récupère l'id

	$querry=$bdd->prepare('DELETE FROM produits WHERE id = ?'); //supprime le produits 	qui corresponds à l'id
	$querry-> execute(array($id_produits));
	header("Location: produits.php?Zftyu45601MlPw8"); //renvoie sur la page profil

?>