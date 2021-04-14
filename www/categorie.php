<?php  
	include("connect.php");
	require_once("include/function.php");
 	log_only();
?>
<html>
<head>
    <title>Profil</title>
    <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/categorie_css.css">
    </style>
</head>
<body>
    <div align="center">
        <table class="test">
            <caption>Catégorie</caption>
	        <tr>
	        <?php 
	            $req = $bdd->query('SELECT * FROM categorie ORDER BY id');//récupérer les noms des titres de  catégories
	            while($row = $req->fetch()) { 
		            

		            $requete = $bdd->prepare('SELECT * FROM souscategorie WHERE id_categorie = ?');//récupérer les noms des  catégories
		            $requete->execute(array($row['id']));
		    ?>
		            <td>
			            <optgroup label="<?php echo $row['nom_categorie'];?>"><!--afficher les titres des catégories-->
			            <?php
			                	while ($sca = $requete->fetch()) { 
			            ?>
			                		<option><?php echo $sca['nom_sous_categorie']; ?></option><!--afficher les catégories-->
			            <?php 
			                    }
			            ?>
		                </optgroup>
		            </td> 
		            <?php $id = base64_encode($row['id']);?>        
		            <td><a href="ajouterCategorie.php?D45uyE47=<?php echo  $id;?>"><input type="button" name="plus" value="+" class="boutton2"></a></td><!--ajouter noms de catégories-->

	              
	            </tr>
            <?php 
                }   
                $req->closeCursor();   
            ?>
        </table>
        <a href="accueil.php" class="ecart"><input type="button" name="retour" value="Retour" class="boutton"></a><!--faire retour-->
        <a href="ajouterTitre.php" class="ecart"><input type="button" value="Ajouter un Titre" class="boutton"></a><!--ajouter un titre de catégories-->
    </div>
</body>
</html>
