<?php
   include("connect.php");
   require_once("include/function.php");
   log_only();

   if(isset($_POST['forminscription'])) {
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);

      if(!empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

            if($mail == $mail2) {

               if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  $reqmail = $bdd->prepare("SELECT * FROM admin WHERE mail = ?");
                  $reqmail->execute(array($mail));
                  $mailexist = $reqmail->rowCount();
                  if($mailexist == 0) {

                     if($mdp == $mdp2) {
                        $insertmbr = $bdd->prepare("INSERT INTO admin( mail, motdepasse) VALUES(?, ?)");
                        $insertmbr->execute(array($mail, $mdp));
                        $erreur = "Votre compte a bien été créé ! <a href=\"connexionAdmin.php\">Me connecter</a>";

                     } else {
                        $erreur = "Vos mots de passes ne correspondent pas !";
                     }

                  } else {
                     $erreur = "Adresse mail déjà utilisée !";
                  }

               } else {
                  $erreur = "Votre adresse mail n'est pas valide !";
               }

            } else {
               $erreur = "Vos adresses mail ne correspondent pas !";
            }

      } else {
         $erreur = "Tous les champs doivent être complétés !";
      }
   }
?>

<DOCTYPE html!>
<html>
<head>
   <title>Inscription</title>
   <meta charset="utf-8">
   <style type="text/css">
      .boutton{
            padding:6px 0 6px 0;
            font:bold 13px Arial;
            background:#478bf9;
            color:#fff;
            border-radius:2px;
            width:200px;
            border:none;
      }
   </style>
</head>
<body>
   <div align="center">
      <h2>Inscription Admin</h2>
      <br /><br />
      <form method="POST" action="">
         <table>
            <tr>
               <td align="right"><label for="mail">Mail :</label></td>
               <td><input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" /></td>
            </tr>
            <tr>
               <td align="right"> <label for="mail2">Confirmation du mail :</label></td>
               <td><input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" /></td>
            </tr>
            <tr>
               <td align="right"><label for="mdp">Mot de passe :</label></td>
               <td><input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" /></td>
            </tr>
            <tr>
               <td align="right"><label for="mdp2">Confirmation du mot de passe :</label></td>
               <td><input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" /></td>
            </tr>
            <tr>
               <td align="center"><br /><a href="connexionAdmin.php"><input type="button" value="Retour" class="boutton"></a></td>
               <td align="center"><br /><input type="submit" name="forminscription" value="Inscription" class="boutton" /></td>
            </tr>
         </table>
      </form>
      <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
      ?>
   </div>
</body>
</html>