<?php 
	include("connect.php");
	require_once("include/function.php");
 	log_only();

	$id_produits = base64_decode($_GET['id']); //récupère l'id

	$bdd->prepare('DELETE FROM produits WHERE id = ?')->execute(array($id_produits)); //supprime le produits qui corresponds à l'id
	header("Location: profil.php"); //renvoie sur la page profil
?>