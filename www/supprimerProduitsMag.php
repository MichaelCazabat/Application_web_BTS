<?php 
	include("connect.php");
	require_once("include/function.php");
 	log_only();

	$id_produits = base64_decode($_GET['id']); //récupère l'id
	$getid_utilisateur = base64_decode($_GET['id_utilisateur']); // récupère l'id de l'utilisateur

	$bdd->prepare('DELETE FROM produits WHERE id = ?')->execute(array($id_produits)); //supprime le produits qui corresponds à l'id
	header("Location: onlyOneMag.php?id_utilisateur=".$getid_utilisateur); //renvoie sur la page profil
?>