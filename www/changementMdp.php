<?php
    include("connect.php");
    require_once("include/function.php");
    log_only();
    
    $init = "0000-00-00 00:00:00";
    $req = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');//on prépare et exécute la requete qui à un utilisateur associe un magasin
    $req->execute(array($_SESSION['id']));
    while($row = $req->fetch()) { 
        if ($row['date_changement']!= $init) {
            if ($row['oublie']==0) {
                header("Location: inscriptionMag.php");
            }else{} 
        }else{}
    }   
    $req->closeCursor();

    if(isset($_SESSION['id'])) {
        $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();


        if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);

          if($mdp1 == $mdp2) {
              $insertmdp = $bdd->prepare("UPDATE utilisateur SET motdepasse = ?, date_changement = NOW(), oublie=0 WHERE id = ?");
              $insertmdp->execute(array($mdp1, $_SESSION['id']));
              header('Location: inscriptionMag.php');

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
            height: 250px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div align="center">
    <h2>Changer votre mot de passe</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <table>
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
            <input type="submit" value="Mettre à jour" class="taille" />
        </form>
        <a href="connexion.php"><input type="button" value="Retour" class="taille"></a>
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