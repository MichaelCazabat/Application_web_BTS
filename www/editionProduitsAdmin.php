<?php
   include("connect.php");
   require_once("include/function.php");
   log_only();

   $id_produits = base64_decode($_GET['poulMWxcn07Y!Sa']);

   if(isset($id_produits)) {
      $requser = $bdd->prepare("SELECT * FROM produits WHERE id = ?");
      $requser->execute(array($id_produits));
      $user = $requser->fetch();

      if(isset($_POST['newreference']) AND !empty($_POST['newreference']) AND $_POST['newreference'] != $user['reference']) {
         $newreference = htmlspecialchars($_POST['newreference']);
         $insertreference = $bdd->prepare("UPDATE produits SET reference = ?,date_produits = NOW() WHERE id = ?");
         $insertreference->execute(array($newreference, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newugs']) AND !empty($_POST['newugs']) AND $_POST['newugs'] != $user['UGS']) {
         $newugs = htmlspecialchars($_POST['newugs']);
         $insertugs = $bdd->prepare("UPDATE produits SET UGS = ?,date_produits = NOW() WHERE id = ?");
         $insertugs->execute(array($newugs, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
         $newnom = htmlspecialchars($_POST['newnom']);
         $insertnom = $bdd->prepare("UPDATE produits SET nom = ?,date_produits = NOW() WHERE id = ?");
         $insertnom->execute(array($newnom, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newprix']) AND !empty($_POST['newprix']) AND $_POST['newprix'] != $user['prix']) {
         $newprix = htmlspecialchars($_POST['newprix']);
         $insertprix = $bdd->prepare("UPDATE produits SET prix = ?,date_produits = NOW() WHERE id = ?");
         $insertprix->execute(array($newprix, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newtva']) AND !empty($_POST['newtva']) AND $_POST['newtva'] != $user['classeTVA']) {
         $newtva = htmlspecialchars($_POST['newtva']);
         $inserttva = $bdd->prepare("UPDATE produits SET classeTVA = ?,date_produits = NOW() WHERE id = ?");
         $inserttva->execute(array($newtva, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newquantite']) AND !empty($_POST['newquantite']) AND $_POST['newquantite'] != $user['quantite']) {
         $newquantite = htmlspecialchars($_POST['newquantite']);
         $insertquantite = $bdd->prepare("UPDATE produits SET quantite = ?,date_produits = NOW() WHERE id = ?");
         $insertquantite->execute(array($newquantite, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newdescription']) AND !empty($_POST['newdescription']) AND $_POST['newdescription'] != $user['description']) {
         $newdescription = htmlspecialchars($_POST['newdescription']);
         $insertdescription = $bdd->prepare("UPDATE produits SET description = ?,date_produits = NOW() WHERE id = ?");
         $insertdescription->execute(array($newdescription, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newnomA1']) AND !empty($_POST['newnomA1']) AND $_POST['newnomA1'] != $user['nomA1']) {
         $newnomA1 = htmlspecialchars($_POST['newnomA1']);
         $insertnomA1 = $bdd->prepare("UPDATE produits SET nomA1 = ?,date_produits = NOW() WHERE id = ?");
         $insertnomA1->execute(array($newnomA1, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newvaleurA1']) AND !empty($_POST['newvaleurA1']) AND $_POST['newvaleurA1'] != $user['valeurA1']) {
         $newvaleurA1 = htmlspecialchars($_POST['newvaleurA1']);
         $insertvaleurA1 = $bdd->prepare("UPDATE produits SET valeur1 = ?,date_produits = NOW() WHERE id = ?");
         $insertvaleurA1->execute(array($newvaleurA1, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newnomA2']) AND !empty($_POST['newnomA2']) AND $_POST['newnomA2'] != $user['nomA2']) {
         $newnomA2 = htmlspecialchars($_POST['newnomA2']);
         $insertnomA2 = $bdd->prepare("UPDATE produits SET nomA2 = ?,date_produits = NOW() WHERE id = ?");
         $insertnomA2->execute(array($newnomA2, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }

      if(isset($_POST['newvaleurA2']) AND !empty($_POST['newvaleurA2']) AND $_POST['newvaleurA2'] != $user['valeurA2']) {
         $newvaleurA2 = htmlspecialchars($_POST['newvaleurA2']);
         $insertvaleurA2 = $bdd->prepare("UPDATE produits SET valeur2 = ?,date_produits = NOW() WHERE id = ?");
         $insertvaleurA2->execute(array($newvaleurA2, $id_produits));
         header('Location: produits.php?Zftyu45601MlPw8=MA==');
      }
?>
<html>
<head>   
   <title>Edition Produits</title>
   <meta charset="utf-8">      
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/editionProduit_css.css">

</head>
<body>
   <div class="login-dark" >
      <h2>Edition d'un produit </h2>
      <form method="POST" action="" enctype="multipart/form-data">
         <table class="tableau">
            <tr>
               <td><label>Référence :</label></td>
               <td><input type="text" name="newreference" value="<?php echo $user['reference']; ?>" /></td>
            </tr>
            <tr>
               <td><label>EAN :</label></td>
               <td><input type="text" name="newugs" value="<?php echo $user['UGS']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Nom :</label></td>
               <td><input type="text" name="newnom" value="<?php echo $user['nom']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Prix :</label></td>
               <td><input type="text" name="newprix" value="<?php echo $user['prix']; ?>" /></td>
            </tr>
            <tr>
               <td><label>% TVA :</label></td>
               <td><input type="text" name="newtva" value="<?php echo $user['classeTVA']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Quantité :</label></td>
               <td><input type="text" name="newquantite" value="<?php echo $user['quantite']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Description :</label></td>
               <td><input type="text" name="newdescription" value="<?php echo $user['description']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Nom Attribut 1 :</label></td>
               <td><input type="text" name="newnomA1" value="<?php echo $user['nomA1']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Valeur Attribut 1  :</label></td>
               <td><input type="text" name="newvaleurA1" value="<?php echo $user['valeur1']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Nom Attribut 2 :</label></td>
               <td><input type="text" name="newnomA2" value="<?php echo $user['nomA2']; ?>" /></td>
            </tr>
            <tr>
               <td><label>Valeur Attribut 2  :</label></td>
               <td><input type="text" name="newvaleurA2" value="<?php echo $user['valeur2']; ?>" /></td>
            </tr>
         </table>
         <br>
         <input type="submit" value="Mettre à jour" class="taille" />
      </form>
      <a href="produits.php?Zftyu45601MlPw8=MA=="><input type="button" value="Retour" class="taille"></a>
   </div>
</body>
</html>
<?php   
}

?>


