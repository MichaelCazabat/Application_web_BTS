<?php 	
	include("connect.php");// Démarer la session 
	require_once("include/function.php");
 	log_only();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="css/utilisateur_css.css">
</head>
<body>
	<div class="bouttons"> 
		<table class="tableau"> <!--tableau d'affichage pour les 2 boutons-->
			<tr>
				<th><a href="liste.php"><input type="button" value="LISTE"></a></th>
				<th><a href="inscription.php"><input type="button" value="NOUVEAU"></a></th>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<a href="accueil.php"><input type="button" value="Retour"></a>
	</div>
</body>
</html>	