<?php
  	include("connect.php");
    require_once("include/function.php");
    log_only();
    $getid_utilisateur = base64_decode($_GET['Zftyu45601MlPw8']);

    if ($getid_utilisateur==0) { //on va chercher tout les produits ordonner du plus petit au plus grand par l'id
        $req = $bdd->query('SELECT * FROM produits ORDER BY id');
    }else{
        $req = $bdd->prepare('SELECT * FROM produits WHERE id_souscategorie = ? ORDER BY id');
        $req->execute(array($getid_utilisateur));
    }

    $req2 = $bdd->query('SELECT * FROM magasin'); //on va chercher le nom des magasins;
    
    if(!empty($_POST)) { //php pour tester  les entrées
        $errors = array(); 

        $id=$_POST['nom_sous_categorie'];
        $reponse = $bdd->prepare('SELECT id FROM souscategorie WHERE nom_sous_categorie LIKE ?');
        $reponse->execute(array($id));
        $rep=$reponse->fetch();
        $rep = base64_encode($rep['id']);
        header("Location: produits.php?Zftyu45601MlPw8=".$rep);
    }
	 

?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8" />
	  <title>Produits</title>
	  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="css/produits_css.css">
</head>
<body>


    <br>
    <div class="div1">
        <?php $categ = $bdd->query('SELECT * FROM categorie'); $i =1; ?>
        <form action="" method="post">
            <table class="affiche">
                <tr>
                    <td><label class="label" for="categorie_Produits">Tri :</label></td>

                    


 <td><select class="selectpicker" name="nom_sous_categorie" id="nom_sous_categorie"><!--affichage de toute les catégories dans le menu déroulant à l'aide d'une requète-->

                    <?php 
                    while($red = $categ->fetch()){

                    	$id_categorie_dropdown = $red['id'];
                        $souscateg = $bdd->prepare('SELECT * FROM souscategorie WHERE id_categorie =  ?');
                        $souscateg->execute(array($id_categorie_dropdown));
                    ?>
                        <optgroup label="<?php echo $red['nom_categorie'];?>">
                    <?php 
                        while ($are = $souscateg->fetch()) {
                    ?>
                            <option><?php echo $are['nom_sous_categorie'];?></option>
                    <?php 
                        } 
                    ?>
                        </optgroup>
                        <?php 
                    }
                    ?>     
                    </select></td>
        	

                </tr>
                <tr>
                    <td colspan="2"><input type="submit"  value="Filtrer" class="boutton"></td>
                </tr>
                <tr>
                    <?php $i=base64_encode(0);
                        if ($getid_utilisateur==0) {   //bouton présent si on utilise un filtre
                        }else{?>
                            <td colspan="2"><a href="produits.php?Zftyu45601MlPw8=<?php echo $i;?>"><input type="button" value="Affichage Complet" class="boutton"></a></td>
                    <?php }
                    ?>
                    
                </tr>
            </table>
        </form>        
    </div>
    
    <div align="center">
            <table class="test">
                <?php 
                $requete = $bdd->prepare('SELECT nom_sous_categorie FROM souscategorie WHERE id = ?');
                $requete->execute(array($getid_utilisateur));
                $toto = $requete->fetch();
                    if ($getid_utilisateur==0) { ?>
                        <caption>Liste des Produits</caption><!--entête des colones du tableau générales-->
                    <?php }else{?><!--entête des colones du tableau par catégorie-->
                        <caption><?php echo $toto['nom_sous_categorie'] ?></caption>
                    <?php }
                ?>
            
            <tr>
                <th>ID</th>
                <th>Catégorie</th>
                <th>Référence</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Description</th>
                <th>Magasin</th>
                <th>Action</th>
            
            </tr>
            <tr>
              <?php while($row = $req->fetch()) { //affichage de tout les éléments sur les produits ainsi que le nom du magasin duquelles ils proviennent
                    $chiffre = $row['id_souscategorie'];
                    $requete = $bdd->prepare('SELECT nom_sous_categorie FROM souscategorie WHERE id = ?');
                    $requete->execute(array($chiffre));?>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php  
                        while($tre = $requete->fetch()){
                            echo $tre['nom_sous_categorie'];
                        }?>
                        </td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['nom']; ?></td>
                        <td><?php echo $row['prix']; ?>&nbsp;&nbsp;<?php echo"€"?></td>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php 
                        $req2 = $bdd->query('SELECT * FROM magasin'); //nom du magasin coreespondant à l'id

                        while ($entier = $req2->fetch()) {
                            if ($entier['id_utilisateur'] == $row['id_utilisateur']) {
                                echo $entier['nom_magasin'];
                            }else{

                            }

                        }
                        ?></td>
                        <?php $id_produits = $row['id'];?>
                        <td><a href="supprimerProduitsAdmin.php?id=<?php echo $id_produits?>">Supprimer</a> / <a href="editionProduitsAdmin.php?poulMWxcn07Y!Sa=<?php echo $id_produits?>">Modifer</a></td>
                        <!--Supprimer / modifie un produit-->
            </tr>
            <?php   
                    }   
            $req->closeCursor();   
            ?>
         </table>
         <a href="accueil.php"><input type="button" value="Retour"></a> <!--bouton qui revient au menu Admin -->


      </div>
</body>

</html>