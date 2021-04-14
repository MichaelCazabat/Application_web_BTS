<?php
   include("connect.php");
   require_once("include/function.php");
   log_only();

   if(isset($_POST['forminscription'])) {
      $pseudo = htmlspecialchars($_POST['pseudo']); //le php récupère les données entrer dans le formulairehtml puis les rentres dans la bdd avec la requète SQL
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $mdp = sha1($_POST['mdp']);
      $mdp2 = sha1($_POST['mdp2']);

      if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
         $pseudolength = strlen($pseudo);

         if($pseudolength <= 255) {

            if($mail == $mail2) {

               if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
                  $reqmail->execute(array($mail));
                  $mailexist = $reqmail->rowCount();

                  if($mailexist == 0) {

                     if($mdp == $mdp2) {
                        $date_changement = "0000-00-00 00:00:00";
                        $oublie = 0;
                        $insertmbr = $bdd->prepare("INSERT INTO utilisateur SET pseudo = ?, mail = ?, motdepasse = ?, date_changement = ?, oublie = ?");
                        $insertmbr->execute(array($pseudo, $mail, $mdp, $date_changement, $oublie));
                        header('Location: utilisateur.php');


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
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
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
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/editionProduit_css.css">
</head>
<body>
   <div align="center">
      <h2>Inscription</h2>
      <br>
      <form method="POST" action="">
         <table>
            <tr>
               <td>
                  <label for="pseudo">Prénom_Nom :</label>
               </td>
               <td>
                  <input type="text" placeholder="Prénom_Nom" id="pseudo" name="pseudo"  />
               </td>
            </tr>
            <tr>
               <td>
                  <label for="mail">Mail :</label>
               </td>
               <td>
                  <input type="email" placeholder="Mail" id="mail" name="mail"  />
               </td>
            </tr>
            <tr>
               <td>
                  <label for="mail2">Confirmation du mail :</label>
               </td>
               <td>
                  <input type="email" placeholder="Confirmez mail" id="mail2" name="mail2" />
               </td>
            </tr>
            <tr>
               <td>
                  <label for="mdp">Mot de passe :</label>
               </td>
               <td>
                  <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" />
               </td>
            </tr>
            <tr>
               <td>
                  <label for="mdp2">Confirmation :</label>
               </td>
               <td>
                  <input type="password" placeholder="Confirmez" id="mdp2" name="mdp2" />
               </td>
            </tr>
            <tr>
               <td align="center">
                  <br />
                  <a href="utilisateur.php"><input type="button" value="Retour" class="taille"></a>
               </td>
               <td align="center">
                  <br />
                  <input type="submit" name="forminscription" value="Enregistrer" class="taille" />
               </td>
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