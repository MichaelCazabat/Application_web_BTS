<?php
    include("connect.php");
    require_once("include/function.php");
    log_only();
    $getid = base64_decode($_GET['D45uyE47']);

    if(!empty($_POST)) {
        $errors = array(); 

        if(empty($_POST['nom']) ) {
        $errors['nom'] =  "le nom renseigner et vide "; //erreur si c'est vide
        } 

        if (empty($errors)) { // insert dans la bdd le nom de la nouvelle  catégorie
        $req = $bdd->prepare("INSERT INTO souscategorie SET  nom_sous_categorie = ?, id_categorie = ?");                  
        $req->execute([$_POST['nom'],$getid]);
        header('Location: categorie.php'); //renvoie sur la page de toute les catégorie
        }
    }
?>
<html>
<head>
    <title>Edition</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/editionProduit_css.css">
</head>
<body>
    <div align="center">
        <h2>Ajouter une Catégorie</h2>
        <form method="POST" action="" enctype="multipart/form-data">
              <table>
                  <tr>
                      <td> <label>Nom de la Catégorie :</label></td>
                      <td><input type="text" name="nom" placeholder="Nom "/></td>
                  </tr>
              </table>
              <br>
              <input type="submit" value="Ajouter" class="taille" />
        </form>
        <a href="categorie.php"><input type="button" name="retour" class="taille" value="Retour"></a>
    </div>
</body>
</html>
