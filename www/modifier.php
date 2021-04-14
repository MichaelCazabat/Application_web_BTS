<?php //page pour modifier son profil, récupère les nouvelles entrer dans le html et les traites dans le php, on les insères dans la bdd avec une requète
    include("connect.php");
    require_once("include/function.php");
    log_only();
    $getid = base64_decode($_GET['AqXy7530-QsE4']);

    if(isset($getid)) {
        $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $requser->execute(array($getid));
        $user = $requser->fetch();

        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);

          if($mdp1 == $mdp2) {
              $insertmdp = $bdd->prepare("UPDATE utilisateur SET motdepasse = ?, oublie=1 WHERE id = ?");
              $insertmdp->execute(array($mdp1, $getid));
              header('Location: liste.php');

          }else {
              $msg = "Vos deux mdp ne correspondent pas !";
          }
      }
?>
<html>
<head>
    <title>Edition</title>
    <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/editionProduit_css.css"></head>
<body>
    <div align="center">
    <h2>Modifier mot de passe</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label>Mot de passe :</label></td>
                    <td><input type="password" name="newmdp1" placeholder="Mot de passe"/></td>
                </tr>
                <tr>
                    <td><label>Confirmation du  mot de passe :</label></td>
                    <td><input type="password" name="newmdp2" placeholder="Mot de passe" /></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Mettre à jour" class="taille" />
        </form>
        <a href="liste.php"><input type="button" value="Retour" class="taille"></a>
        <?php if(isset($msg)) { echo $msg; } ?>
    </div>
</body>
</html>
<?php   
}
else {
   header("Location: index.php");
}
?>