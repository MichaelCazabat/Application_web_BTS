<?php
require_once("include/function.php");
    log_only();
include("connect.php");


	$req = $bdd->query('SELECT * FROM produits ORDER BY id');
 
$resultat = "ID;Type;UGS;Nom;Publié;Mis en avant ?;Visibilité dans le catalogue;Description courte;Description;Etat de la TVA;Classe TVA;En stock ?;Stock;Autoriser les commandes de produits en rupture ?;Vendre indivuellement ?;Autoriser les avis clients ?;Tarif régulier;Catégories;Nom de l\'attribut 1;Valeur de l\'attribut 1;Attribut 1 visible;Nom de l\'attribut 2;Valeur de l\'attribut 2;Attribut 2 visible"."\n";

    $tom = NULL;
	while ($row = $req->fetch()) { 
		$chiffre = $row['id_souscategorie'];
        $requete = $bdd->prepare('SELECT nom_sous_categorie FROM souscategorie WHERE id = ?');
        $requete->execute(array($chiffre));
        while($tre = $requete->fetch()){ 
        	$thomas= $row['reference'].';';
        	$thomas.= $row['type'].';';
        	$thomas.= $row['UGS'].';';
        	$thomas.= $row['nom'].';';
        	$thomas.= $row['publie'].';';
        	$thomas.= $row['MEA'].';';
        	$thomas.= $row['visible'].';';
        	$thomas.= $row['descriptioncourte'].';';
        	$thomas.= $row['description'].';';
        	$thomas.= $row['etat'].';';
        	$thomas.= $row['classeTVA'].';';
        	$thomas.= $row['stock'].';';
        	$thomas.= $row['quantite'].';';
        	$thomas.= $row['autoriser'].';';
        	$thomas.= $row['autoriser'].';';
        	$thomas.= $row['autoriser'].';';
        	$thomas.= $row['prix'].';';
        	$thomas.= $tre['nom_sous_categorie'].';';
        	$thomas.= $row['nomA1'].';';
        	$thomas.= $row['valeur1'].';';
        	$thomas.= $row['attribut1'].';';
        	$thomas.= $row['nomA2'].';';
        	$thomas.= $row['valeur2'].';';
        	$thomas.= $row['attribut2'];

	    } 

	    $tom .= $thomas."\n"; 

	}
     
$list = array (
array($resultat),
array($tom)
);
$fp = fopen("export.csv", "w");
foreach($list as $fields):
    fputcsv($fp, $fields);
endforeach;
fclose($fp);
header("Content-Type: text/csv");
header("Content-disposition: filename=export.csv");
header('Location: export.csv');

?>
