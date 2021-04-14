<!--Script PHP permettant de se connecter a la base et qui permet de verifier si les mots de passe sonts bon-->
<?php 
    include("connect.php");

    if(isset($_POST['formconnexion'])) {
        $mailconnect = htmlspecialchars($_POST['mailconnect']);
        $mdpconnect = sha1($_POST['mdpconnect']);

        if(!empty($mailconnect) AND !empty($mdpconnect)) {
            $requser = $bdd->prepare("SELECT * FROM admin WHERE mail = ? AND motdepasse = ?");
            $requser->execute(array($mailconnect, $mdpconnect));
            $userexist = $requser->rowCount();

            if($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['mail'] = $userinfo['mail'];
                header("Location: accueil.php");
                
                


            }else {
                 $erreur = "Mauvais mail ou mot de passe !";
            }

        }else {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }
?>
<html>
<head>
	<meta charset="utf-8">
    <title>Connexion</title>    

   <!--link pour le CSS et link CDN(lien vers un css/dossier host par quelqu'un qui nous permet de ne pas en faire un) et lien vers l'icone de cadenas -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
    <div class="login-dark">
        <form method="POST">
            <h2 class="sr-only">Connexion</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>

            <!--Formulaire permenttant d'entrer nos logins-->
            <div class="form-group"><input class="form-control" type="email" name="mailconnect" placeholder="e-mail"> 
            <div class="form-group"><input class="form-control" type="password" name="mdpconnect" placeholder="Mots de passe"> 
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="formconnexion" href="#">Se connecter</button></div>
            


            <!--Script PHP qui permet d'afficher une erreur en rouge si on a une mauvais mots de passe ou une mauvaise une mauvaise adresse e-mail. -->
            <?php
                if(isset($erreur)) {
                    echo '<font color="red">'.$erreur."</font>";
                }
            ?>

        </form>
    </div>
</body>

</html>