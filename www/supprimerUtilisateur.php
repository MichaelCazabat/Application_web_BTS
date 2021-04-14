<?php 
	include("connect.php");
	require_once("include/function.php");
 	log_only();

	$id_utilisateur = base64_decode($_GET['id']);//récpère l'id
	//supprime l'utilisateur et le magasin qui corresponds a l'id
	$bdd->prepare('DELETE FROM utilisateur WHERE id = ?')->execute(array($id_utilisateur)); 
	$bdd->prepare('DELETE FROM magasin WHERE id_utilisateur = ?')->execute(array($id_utilisateur));
	header("Location: magasin.php"); //renvoie à la pag magasin

?>