<?php 
	include("connect.php");


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Menu</title>
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/accueil_css.css">

</head>
<body>
	    
	<?php $i=base64_encode(0); ?>
	<div align="center"> 
		<div class="login-dark">
		<table> <!--tableau d'affichage pour les 4 boutons-->
			<tr>	
				<th class=""><a href="magasin.php"><input class="btn btn-primary btn-block" type="button" value="MAGASIN"></a></th>
				<th><a href="produits.php?Zftyu45601MlPw8=<?php echo $i; ?>"><input class="btn btn-primary btn-block" type="button" value="PRODUITS"></a></th>
			</tr>
			<tr>
				<td><a href="categorie.php"><input class="btn btn-primary btn-block" type="button" value="CATEGORIE"></a></td>
				<td><a href="utilisateur.php"><input class="btn btn-primary btn-block" type="button" value=" UTILISATEUR"></a></td>

			</tr>
		</table>
		<br>
		<br>
		<br>
		<a href="deconnexion.php"><input type="button" value="Se Déconnecter"></a>


		</div>
	</div>
</body>
</html>