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
	
    <title>Connexion</title>


    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index_css.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   

    <style type="text/css" href="connexion.css">/*affichage des boutons plus du bloc au milieu*/</style>
    
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form method="POST" action=""  class="box">

                        <h1>Connexion</h1>
                        <p class="text-muted"> Veuillez entrer votre identifiants et votre mots de passe</p> 
                        <input type="email" name="mailconnect" placeholder="e-mail"> 
                        <input type="password" name="mdpconnect" placeholder="Mots de passe"> 
                        <input type="submit" name="formconnexion" value="Se connecter" href="#">
                        <?php
                            if(isset($erreur)) {
                              echo '<font color="red">'.$erreur."</font>";
                            }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>