<?php
    session_start();
    include("connect.php");
    require_once("include/function.php");
    log_only();
    
    $errors = array(); 
    if(!empty($_POST)) { //php pour tester toute les entrer 
        

        if(empty($_POST['nom_sous_categorie'])) {
            $errors['nom_sous_categorie'] =  "la catégorie renseigner n'est pas valide ou vide  (alpha-numeriques ) ";  
        } 

        $id=$_POST['nom_sous_categorie'];
        $reponse = $bdd->prepare('SELECT id FROM souscategorie WHERE nom_sous_categorie LIKE ?');
        $reponse->execute(array($id));
        $rep=$reponse->fetch();

        if(empty($_POST['reference'])) {
            $errors['reference'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 

        if(empty($_POST['ugs'])) {
            $errors['ugs'] =  "EAN renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['nom'])) {
            $errors['nom'] =  "le nom renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 

        if(empty($_POST['prix']) || !preg_match('/^[0-9]+$/', $_POST['prix'])) {
            $errors['prix'] =  "la prix renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 

        if(empty($_POST['tva'])) {
            $errors['tva'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['quantite']) || !preg_match('/^[0-9]+$/', $_POST['quantite'])) {
            $errors['quantite'] =  "la quantité renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        } 

        if(empty($_POST['description']) ) {
            $errors['description'] =  "la description renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['nomAttribut1'])) {
            $errors['nomAttribut1'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['valeurAttribut1'])) {
            $errors['valeurAttribut1'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['nomAttribut2'])) {
            $errors['nomAttribut2'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }

        if(empty($_POST['valeurAttribut2'])) {
            $errors['valeurAttribut2'] =  "la référence renseigner n'est pas valide ou vide  (alpha-numeriques ) ";
        }
        //Colonne forcer
        $date_produits = NOW();
                    $type = "simple";
                    $publie = 1;
                    $MEA = 0;
                    $visible = "visible";
                    $etat = "taxable";
                    $stock = 1;
                    $attribut = 0;
                    $autoriser = 0;
                    $descriptioncourte = $_POST['description'];

        if (empty($errors)) {  //ajoute les données reccueillis dans la bdd
            if(isset($_SESSION['id_utilisateur']) AND $_SESSION['id_utilisateur'] > 0) {    
                $req = $bdd->prepare("INSERT INTO produits SET  reference = ?, nom = ?, prix = ?, quantite = ?, description = ?, date_produits = ?, id_utilisateur = ?, id_souscategorie = ?, type = ?, UGS = ?, publie = ?, MEA = ?, visible = ?, descriptioncourte = ?, etat = ?, classeTVA = ?, stock = ?, autoriser = ?, nomA1 = ?, valeur1 = ?, attribut1 = ?, nomA2 = ?, valeur2 = ?, attribut2 = ? ");                  
                $req->execute(array($_POST['reference'],$_POST['nom'],$_POST['prix'], $_POST['quantite'], $_POST['description'], $date_produits, $_SESSION['id_utilisateur'], $rep['id'], $type, $_POST['ugs'], $publie, $MEA, $visible, $descriptioncourte, $etat, $_POST['tva'], $stock, $autoriser, $_POST['nomAttribut1'], $_POST['valeurAttribut1'], $attribut, 
                    $_POST['nomAttribut2'], $_POST['valeurAttribut2'], $attribut));

                $_SESSION['flash']['success'] = "Le produit a bien etait ajoutez";
            } 
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  	<title>POP UP</title>
  	<meta charset="utf-8">
  	
</head>
<body onunload="window.opener.location.reload();"><!--recharger la page qui a ouvert le POP-UP lors de la fermeture de celui-ci-->
	<?php if(!empty($errors)): ?>
        <div class="alert_danger"><!--gérer les erreurs de formulaires-->
            <p>Vous n'avez pas rempli le formulaire correctement </p>

            <?php foreach($errors as $error): ?>
                <ul>
                    <li><?= $error; ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    <?php endif?>

    <div id="frm">
		<?php $categ = $bdd->query('SELECT nom_categorie FROM categorie'); $i =1; ?>
        <form action="" method="post" onsubmit="self.close()"><!--Quand le formulaire est remplis et valider la page se ferme toute seul-->
            <table class="affiche">
                <tr>
                    <td><label for="categorie_Produits">Catégorie :</label></td>
                    <td><select name="nom_sous_categorie" id="nom_sous_categorie"><!--affichage de toute les catégories dans le menu déroulant à l'aide d'une requète-->
                        <option>-</option>
                    <?php 
                    while($red = $categ->fetch()){
                        $souscateg = $bdd->prepare('SELECT nom_sous_categorie FROM souscategorie WHERE id_categorie =  ?');
                        $souscateg->execute(array($i));
                    ?>
                        <optgroup label="<?php echo $red['nom_categorie'];?>">
                    <?php 
                        while ($are = $souscateg->fetch()) {
                    ?>
                            <option><?php echo $are['nom_sous_categorie']?></option>
                    <?php 
                        } 
                    ?>
                        </optgroup>
                        <?php $i=$i+1;
                    }
                    ?>     
                    </select></td>
                </tr>
                <tr>
                    <td><label>Référence :</td> <!--affichage des différents champs avec le "name" qui leurs est attribuer pour récupérer les données dans le php-->
                    <td> <input type="text" name="reference"></label></td>
                </tr>
                 <tr>
                    <td><label>EAN :</td>
                    <td> <input type="text" name="ugs"></label></td>
                </tr>
                <tr>
                    <td><label>Nom :</td>
                    <td><input type="text" id="nom" name="nom"></label></td>
                </tr>
                <tr>
                    <td><label>Prix :</td>
                    <td><input type="text" id="prix"  name="prix"></label></td>
                </tr>
                 <tr>
                    <td><label>% TVA :</td>
                    <td> <input type="text" name="tva"></label></td>
                </tr>
                <tr>
                    <td><label>Quantité :</td>
                    <td><input type="text" id="quantite" name="quantite" ></label></td>
                </tr>
                <tr>
                    <td><label>Description :</td>
                    <td><input type="text" id="description" name="description"></label></td>
                </tr>
                 <tr>
                    <td><label>Nom attribut 1 :</td> 
                    <td> <input type="text" name="nomAttribut1"></label></td>
                </tr>
                 <tr>
                    <td><label>Valeur attribut 1 :</td>
                    <td> <input type="text" name="valeurAttribut1"></label></td>
                </tr>
                <tr>
                    <td><label>Nom attribut 2 :</td> 
                    <td> <input type="text" name="nomAttribut2"></label></td>
                </tr>
                 <tr>
                    <td><label>Valeur attribut 2 :</td>
                    <td> <input type="text" name="valeurAttribut2"></label></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit"  value="Ajouter" class="boutton"></td>
                </tr>
            </table>
        </form>        
    </div>
</body>
</html>
<style type="text/css">
        body{
            background-color: #478bf9;
        }
        div{ /* mise en place de la div au milieu*/
            margin-top: 50vh; 
            transform: translateY(-50%);
            border-radius: 10px;
            border: 5px black solid;
            background-color: white;
            width: 300px;
            height: 370px;
            margin-left: auto;
            margin-right: auto;
            padding: 40px;
        }
            .boutton{ /*affichage du boutton*/
            padding:6px 0 6px 0;
            font:bold 13px Arial;
            background:#478bf9;
            color:#fff;
            border-radius:2px;
            width:270px;
            border:none;
        } 
      </style>