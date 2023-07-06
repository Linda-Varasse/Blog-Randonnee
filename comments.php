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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id'];
    $q = $connexion->prepare(
        'INSERT INTO comments(article_id, pseudo, content, created_at)
        VALUES (:articleId, :pseudonyme, :message, NOW())'
    );
    $q->execute([
        ':articleId'    => $_POST['id'],
        ':pseudonyme'   => htmlspecialchars($_POST['pseudo']),
        ':message'      => htmlspecialchars($_POST['message'])
    ]);
    header("Location: see_comments.php?id=" . $articleId);
    exit();
}
