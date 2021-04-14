<?php 
	include("connect.php");
	require_once("include/function.php");
 	log_only();
    //var_dump($_SESSION);
	$req = $bdd->query('SELECT * FROM magasin ORDER BY id');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Magasin</title>
	  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/produits_css.css"> 	
</head>
<body>
	<div align="center">
		<table class="test">
            <caption>Liste des Magasins :</caption>  
            <tr>
               	<th>ID</th>
               	<th>MAGASIN</th>
 				<th>GERANT</th>
 				<th>SUPRESSION</th>
            </tr>
            <tr>         	
                <?php while($row = $req->fetch()) { ?>
                <td><?php echo $row['id']; ?></td>
                <?php $id = base64_encode($row['id_utilisateur']);?>
                <td><?php echo $row['nom_magasin'];?></td>
                <td><?php echo $row['nomGerant']; echo " ".$row['prenomGerant']; ?></td>  
                <td><a href="supprimerUtilisateur.php?id=<?php echo $id?>">Supprimer</a></td>         
            </tr>
            <?php 
        	}
            $req->closeCursor();   
            ?>
        </table>
        <br>
		<a href="accueil.php" ><input type="button" name="all" value="Retour" class="taille"></a> <!-- boutton Retour-->
	</div>	
</body>
</html>
