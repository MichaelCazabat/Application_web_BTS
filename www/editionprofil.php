<?php //page pour modifier son profil, récupère les nouvelles entrer dans le html et les traites dans le php, on les insères dans la bdd avec une requète
    include("connect.php");
    require_once("include/function.php");
    log_only();

    if(isset($_SESSION['id'])) {
        $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();

        if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $insertpseudo = $bdd->prepare("UPDATE utilisateur SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            header('Location: profil.php');
        } 

        if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $bdd->prepare("UPDATE utilisateur SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: profil.php');
        }

        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);

          if($mdp1 == $mdp2) {
              $insertmdp = $bdd->prepare("UPDATE utilisateur SET motdepasse = ? WHERE id = ?");
              $insertmdp->execute(array($mdp1, $_SESSION['id']));
              header('Location: profil.php');

          }else {
              $msg = "Vos deux mdp ne correspondent pas !";
          }
      }
?>
<html>
<head>
    <title>Edition</title>
    <meta charset="utf-8">
    <style type="text/css">
        .taille{ /*affichage bouton*/
            padding:6px 0 6px 0;
            font:bold 13px Arial;
            background:#478bf9;
            color:#fff;
            border-radius:2px;
            width:200px;
            border:none;
        }
        body{
            background-color: #478bf9;
        }
        div{ /*affichage div*/
            margin-top: 50vh; 
            transform: translateY(-50%); 
            border-radius: 10px;
            border: 5px black solid;
            background-color: white;
            width: 500px;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div align="center">
    <h2>Edition de mon profil</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <table>
                <tr>
                    <td> <label>Prénom_Nom :</label></td>
                    <td><input type="text" name="newpseudo" placeholder="Prenom_Nom" value="<?php echo $user['pseudo']; ?>" /></td>
                </tr>
                <tr>
                    <td><label>Mail :</label></td>
                    <td><input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /></td>
                </tr>
                <tr>
                    <td><label>Mot de passe :</label></td>
                    <td><input type="password" name="newmdp1" placeholder="Mot de passe"/></td>
                </tr>
                <tr>
                    <td><label>Confirmation du  mot de passe :</label></td>
                    <td><input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Mettre à jour mon profil" class="taille" />
        </form>
        <a href="profil.php"><input type="button" value="Retour" class="taille"></a>
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