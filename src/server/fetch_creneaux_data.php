<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config_database.php';

$users = ["etudiant" => "etudiants", "enseignant" => "enseignants", "admin" => "administratifs"];
$table_cible = $users[$_SESSION['statut']];
$data_cible = "creneaux.matiere AS matiere,
    creneaux.enseignant AS enseignant,
    creneaux.salle AS salle,
    creneaux.promotion AS promotion,
    creneaux.departement AS departement,
    creneaux.heure_debut AS heure_debut,
    creneaux.heure_fin AS heure_fin,
    creneaux.date_cours AS date_cours,
    creneaux.type_cours AS type_cours";

if ($table_cible === "etudiants") {
    $sql = "SELECT $data_cible
    FROM etudiants
    JOIN creneaux ON etudiants.promotion = creneaux.promotion
        AND etudiants.departement = creneaux.departement
    WHERE etudiants.nom = :nom";
} elseif ($table_cible === "enseignants") {
    $sql = "SELECT $data_cible
    FROM creneaux
    WHERE creneaux.enseignant = :nom";
} else {
    $sql = "SELECT $data_cible
    FROM creneaux";
}

$stmt = $db->prepare($sql);
$stmt->bindParam(':nom', $_SESSION['nom'], PDO::PARAM_STR);

$result = $stmt->execute();
if (!$result) {
    echo "Erreur lors de la requête<br>";
    exit;
}

$creneaux = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $creneaux[] = $row;
}

if (!$creneaux) {
    echo "Erreur lors de la lecture du résultat<br>";
    exit;
}

$json = json_encode($creneaux);
echo $json;
?>