<?php
session_start();
require_once "./config_database.php";

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['mot_de_passe']) && !empty($_POST['mot_de_passe'])
    && isset($_POST['userType']) && !empty($_POST['userType'])
) {
    $userType = trim(htmlspecialchars($_POST['userType']));
    $users = ["etudiant" => "etudiants", "enseignant" => "enseignants", "admin" => "administratifs"];
    if (array_key_exists($userType, $users)) {
        $table = $users[$userType];
    } else {
        echo "<p>Nom de table incconue</p>";
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM $table WHERE nom = :nom");

    $nom = trim(htmlspecialchars($_POST['nom']));
    $mot_de_passe = trim(htmlspecialchars($_POST['mot_de_passe']));

    $stmt->bindParam(':nom', $nom, SQLITE3_TEXT);

    $result = $stmt->execute();
    if (!$result) {
        echo "<p>Erreur lors de l'exécution de la requête préparée</p>";
        exit;
    }

    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['nom'] = $nom;
        $_SESSION['statut'] = $userType;
        $_SESSION['date_inscription'] = $user['date_inscription'];
        $db->close();
        header("Location: home.php");
        exit;
    } else {
        echo "<p>Identifiants incorrects</p>";
        $db->close();
    }
} else {
    header("Location: ../../index.html");
    exit;
}
?>