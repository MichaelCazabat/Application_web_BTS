<?php 
    include("connect.php");
    require_once("include/function.php");
    log_only();

    
    $req = $bdd->query('SELECT * FROM utilisateur ORDER BY id');;

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
            <caption>Liste des Utilisateur :</caption>  
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>MAIL</th>
                <th>MOT DE PASSE</th>
                <th>ACTION</th>
            </tr>
            <tr>            
                <?php while($row = $req->fetch()) { ?>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['pseudo'];?></td>
                <td><?php echo $row['mail'];?></td>
                <td><?php echo $row['motdepasse'];?></td>  
                <?php $id = base64_encode($row['id']);?>
                <td><a href="modifier.php?AqXy7530-QsE4=<?php echo $id;?>">Modifier</a></td>         
            </tr>
            <?php 
            }
            $req->closeCursor();   
            ?>
        </table>
        <br>
        <a href="utilisateur.php" ><input type="button" name="all" value="Retour" class="taille"></a> <!-- boutton Retour-->
    </div>  
</body>
</html>
