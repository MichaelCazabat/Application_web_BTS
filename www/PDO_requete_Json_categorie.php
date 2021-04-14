<?php
$pdo = new PDO("mysql:dbname=aico2742_bdd;host=mysql-aico2742.alwaysdata.net", "aico2742", "Michaelcazabat777");
$statement = $pdo->prepare("SELECT nom_sous_categorie FROM souscategorie");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode(['produits'=>$results],JSON_PRETTY_PRINT);


 header('Content-Type:Application/json');

echo $json;