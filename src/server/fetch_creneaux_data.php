<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$stmt->bindParam(':nom', $_SESSION['nom']);

$result = $stmt->execute();
if (!$result) {
    echo json_encode("Erreur lors de la requête");
    exit;
}

$creneaux = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $creneaux[] = $row;
}

if (!$creneaux) {
    echo json_encode("Erreur lors de la lecture du résultat");
    exit;
}

$json = json_encode($creneaux);
echo $json;
?>