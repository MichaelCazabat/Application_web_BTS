<?php
    include("connect.php");
    require_once("include/function.php");
    log_only();
    //var_dump($_SESSION);
    
    $req = $bdd->query('SELECT id_utilisateur FROM magasin');//on prépare et exécute la requete qui à un utilisateur associe un magasin
    while($row = $req->fetch()) { 
          if ($row['id_utilisateur']==$_SESSION['id_utilisateur']) {//si un id à un magasin alors on saute la page
              header("Location: profil.php");
              $req->closeCursor();
          }else{}
    }   
    $req->closeCursor(); 
        

    if(!empty($_POST)) {
        $errors = array(); // on traite les données inscrite dans le formulaire html pour ensuite les rentrer dans la base de donnée

        if(empty($_POST['nom_magasin'])) {
            $errors['nom_magasin'] =  "le nom renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 

        if(empty($_POST['siret']) || !preg_match('/^[0-9]+$/', $_POST['siret'])) {
            $errors['siret'] =  "le n siret renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 
        if(empty($_POST['telephone']) || !preg_match('/^[0-9]+$/', $_POST['telephone'])) {
            $errors['telephone'] =  "le tél renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 
        if(empty($_POST['adresse'])) {
            $errors['adresse'] =  "l'adresse renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 
        if(empty($_POST['codepostale']) || !preg_match('/^[0-9]+$/', $_POST['codepostale'])) {
            $errors['codepostale'] =  "le codepostale renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 
        if(empty($_POST['ville']) ) {
            $errors['ville'] =  "la ville renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }
        if(empty($_POST['nomGerant']) ) {
            $errors['nomGerant'] =  "le nom du gerant renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }
        if(empty($_POST['prenomGerant']) ) {
            $errors['prenomGerant'] =  "le prenom du gerant renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }
            
        if (empty($errors)) {  //on rentre ces données dans la bdd
            if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur'] > 0) {    
            $req = $bdd->prepare("INSERT INTO magasin SET  nom_magasin = ?,  siret = ?, telephone = ?, adresse = ?, codepostale = ?, ville = ?, nomGerant = ?, prenomGerant = ?, id_utilisateur = ?");                  
            $req->execute([$_POST['nom_magasin'],$_POST['siret'],$_POST['telephone'],$_POST['adresse'], $_POST['codepostale'], $_POST['ville'], $_POST['nomGerant'], $_POST['prenomGerant'], $_SESSION['id_utilisateur']]);
            header("Location: profil.php");
            } 
        }
    }
?>

<DOCTYPE html!>
<html>
<head>
    <title>InscriptionMag</title>
    <meta charset="utf-8">
    <style type="text/css">
        .taille{ /*affichage boutton*/
            padding:6px 0 6px 0;
            font:bold 13px Arial;
            background:#478bf9;
            color:#fff;
            border-radius:2px;
            width:120px;
            border:none;
        }
        input.ecart{/*écart entre les boutons*/
            padding: 20px;
        }
        body{
            background-color: #478bf9;
        }
        div{ /*affichage du bloc au centre*/
            margin-top: 50vh; 
            transform: translateY(-50%); 
            border-radius: 10px;
            border: 5px black solid;
            background-color: white;
            width: 500px;
            height: 380px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div align="center"><!-- on entre les infos de le formulaires qui est dans un tableau pour un affichage propre-->
        <h2>Inscription Magasin</h2>
        <br>
        <form method="POST" action="">
            <table>
                <tr>
                    <td>
                        <label for="nom_M">Nom Magasin :</label>
                    </td>
                    <td>
                      <input type="text" placeholder="nom magasin" name="nom_magasin" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="siret_M">N° Siret :</label>
                    </td>
                    <td>
                         <input type="text" placeholder="siret" name="siret" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="telephone">Téléphone :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="téléphone" name="telephone" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <label for="adresse">Adresse :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="adresse" name="adresse" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="codepostale">Code Postale :</label>
                    </td>
                    <td>
                        <input type="etext" placeholder="code postale"  name="codepostale" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="ville">Ville :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Ville" name="ville"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nomGerant">Nom Gérant :</label>
                  </td>
                    <td>
                        <input type="text" placeholder="Nom Gerant" name="nomGerant" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="prenomGerant">Prénom Gérant :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Prénom Gérant" name="prenomGerant" />
                    </td>
                </tr>
                <tr>
                    <td align="center" class="ecart">
                        <br />
                        <a href="connexion.php"><input type="button" value="Retour" class="taille"></a>
                    </td>
                    <td align="center" class="ecart">
                        <br />
                        <input type="submit" name="forminscription" value="Valider" class="taille" />
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