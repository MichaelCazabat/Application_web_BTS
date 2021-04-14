<?php
    include("connect.php");
    require_once("include/function.php");
    log_only();

    if(!empty($_POST)) {
        $errors = array(); 

        if(empty($_POST['nom']) ) { //insérer le titre d'une catégorie
            $errors['nom'] =  "le nom renseigner est vide ";
        }

       if (empty($errors)) {      
            $req = $bdd->prepare("INSERT INTO categorie SET  nom_categorie = ?");                  
            $req->execute([$_POST['nom']]);
            header('Location: categorie.php');    
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
        <h2>Ajouter un Titre de Catégorie</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td> <label>Titre :</label></td> <!--récupérer le nouveau champs pour le php-->
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
