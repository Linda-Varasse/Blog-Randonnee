<?php
$serveur = "localhost"; // Adresse du serveur de base de données
$nomUtilisateur = "root"; // Nom d'utilisateur de la base de données
$motDePasse = ""; // Mot de passe de la base de données
$nomBaseDeDonnees = "rando_comments"; // Nom de la base de données

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$articleId = $_GET['id'];
// Récupérer les commentaires associés à l'article spécifique
$requete = $connexion->prepare("SELECT * FROM comments WHERE article_id = ?");
$requete->execute([$articleId]);
$comments = $requete->fetchAll();

if ($articleId == 1) {
    include "Saint_saturnin/Saint_saturnin.phtml";
} else if ($articleId == 2) {
    include "Rocamadour/rocamadour.phtml";
} else if ($articleId == 3) {
    include "Lac_neouvielle/Lac_neouvielle.phtml";
} else {
    echo "L'article demandé n'existe pas.";
}
