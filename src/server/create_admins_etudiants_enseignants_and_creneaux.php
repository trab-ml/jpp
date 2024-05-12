<?php
require_once "./config_database.php";

echo "<h1>Insertion admins...</h1>";

$sql = 'INSERT INTO administratifs(nom, mot_de_passe, date_inscription) VALUES (:nom, :mot_de_passe, :date_creation)';
$stmt = $db->prepare($sql);
$current_date = date("Y-m-d");

$admins = [
    ["nom" => "John Dupont", "mot_de_passe" => "jd24*", "date_creation" => $current_date],
    ["nom" => "Alice Smith", "mot_de_passe" => "as23!", "date_creation" => $current_date],
    ["nom" => "Bob Johnson", "mot_de_passe" => "bj45#", "date_creation" => $current_date]
];
foreach ($admins as $admin) {
    $stmt->bindParam(':nom', $admin['nom']);
    $hashed_password = password_hash($admin['mot_de_passe'], PASSWORD_DEFAULT);
    $stmt->bindParam(':mot_de_passe', $hashed_password);
    $stmt->bindParam(':date_creation', $admin['date_creation']);

    $result = $stmt->execute();
    if (!$result) {
        echo "Erreur lors de l'insertion" . $admin['nom'] . "<br>" . $db->lastErrorMsg() . "<br>";
    } else {
        echo "Compte " . $admin['nom'] . " créé avec succès.<br>";
    }
}

echo "<h1>Insertion enseignants...</h1>";

$sql = 'INSERT INTO enseignants(nom, mot_de_passe, date_inscription) VALUES (:nom, :mot_de_passe, :date_creation)';
$stmt = $db->prepare($sql);

$enseignants = [
    ["nom" => "Johnny English", "mot_de_passe" => "je42*", "date_creation" => $current_date],
    ["nom" => "Bob Dupont", "mot_de_passe" => "bd35!", "date_creation" => $current_date],
    ["nom" => "Quentin Legrand", "mot_de_passe" => "ql32#", "date_creation" => $current_date],
    ["nom" => "Albert Chtein", "mot_de_passe" => "ac37#", "date_creation" => $current_date],
    ["nom" => "Damien Dubois", "mot_de_passe" => "dd45!", "date_creation" => $current_date],
];
foreach ($enseignants as $enseignant) {
    $stmt->bindParam(':nom', $enseignant['nom']);
    $hashed_password = password_hash($enseignant['mot_de_passe'], PASSWORD_DEFAULT);
    $stmt->bindParam(':mot_de_passe', $hashed_password);
    $stmt->bindParam(':date_creation', $enseignant['date_creation']);

    $result = $stmt->execute();
    if (!$result) {
        echo "Erreur lors de l'insertion: " . $enseignant['nom'] . "<br>" . $db->lastErrorMsg() . "<br>";
    } else {
        echo "Compte " . $enseignant['nom'] . " créé avec succès.<br>";
    }
}

echo "<h1>Insertion étudiants...</h1>";

$sql = 'INSERT INTO etudiants(nom, promotion, departement, mot_de_passe, date_inscription) VALUES (:nom, :promotion, :departement, :mot_de_passe, :date_creation)';
$stmt = $db->prepare($sql);

$etudiants = [
    ["nom" => "John Leroux", "promotion" => "Promo L3 MATH 2024", "departement" => "MATH", "mot_de_passe" => "jd22*", "date_creation" => $current_date],
    ["nom" => "Albert Eteint", "promotion" => "Promo L3 INFO 2024", "departement" => "INFO", "mot_de_passe" => "ae33!", "date_creation" => $current_date],
    ["nom" => "Jeanne Darc", "promotion" => "Promo L3 SVT 2024", "departement" => "SVT", "mot_de_passe" => "jd19#", "date_creation" => $current_date]
];
foreach ($etudiants as $etudiant) {
    $stmt->bindParam(':nom', $etudiant['nom']);
    $stmt->bindParam(':promotion', $etudiant['promotion']);
    $stmt->bindParam(':departement', $etudiant['departement']);
    $hashed_password = password_hash($etudiant['mot_de_passe'], PASSWORD_DEFAULT);
    $stmt->bindParam(':mot_de_passe', $hashed_password);
    $stmt->bindParam(':date_creation', $etudiant['date_creation']);

    $result = $stmt->execute();
    if (!$result) {
        echo "Erreur lors de l'insertion: " . $etudiant['nom'] . "<br>" . $db->lastErrorMsg() . "<br>";
    } else {
        echo "Compte utilisateur " . $etudiant['nom'] . " créé avec succès.<br>";
    }
}

echo "<h1>Insertion creneaux...</h1>";

$sql = 'INSERT INTO creneaux(matiere, enseignant, salle, promotion, heure_debut, heure_fin, date_cours, type_cours, departement) VALUES (:matiere, :enseignant, :salle, :promotion, :heure_debut, :heure_fin, :date_cours, :type_cours, :departement)';
$stmt = $db->prepare($sql);

// heure en sqlite3 https://www.sqlite.org/lang_datefunc.html

$nextMonday = strtotime("next Monday");
$nextMondayStr = date('Y-m-d', $nextMonday);

$nextTuesday = strtotime("next Tuesday");
$nextTuesdayStr = date('Y-m-d', $nextTuesday);

$nextFriday = strtotime("next Friday");
$nextFridayStr = date('Y-m-d', $nextFriday);

$creneaux = [
    ["matiere" => "POO", "enseignant" => "Bob Dupont", "salle" => "S16", "promotion" => "Promo L3 INFO 2024", "departement" => "INFO", "heure_debut" => "8:15", "heure_fin" => "10:15", "date_cours" => $nextMondayStr, "type_cours" => "CM"],
    ["matiere" => "Anglais", "enseignant" => "Johnny English", "salle" => "E7", "promotion" => "Promo L3 INFO 2024", "departement" => "INFO", "heure_debut" => "10:30", "heure_fin" => "12:30", "date_cours" => $nextMondayStr, "type_cours" => "CM"],
    ["matiere" => "COO", "enseignant" => "Damien Dubois", "salle" => "S16", "promotion" => "Promo L3 INFO 2024", "departement" => "INFO", "heure_debut" => "14:30", "heure_fin" => "16:30", "date_cours" => $nextMondayStr, "type_cours" => "CM"],
    ["matiere" => "Anglais", "enseignant" => "Johnny English", "salle" => "E7", "promotion" => "Promo L3 SVT 2024", "departement" => "SVT", "heure_debut" => "10:30", "heure_fin" => "12:30", "date_cours" => $nextTuesdayStr, "type_cours" => "CM"],
    ["matiere" => "Chimie", "enseignant" => "Albert Chtein", "salle" => "P100", "promotion" => "Promo L3 SVT 2024", "departement" => "SVT", "heure_debut" => "08:15", "heure_fin" => "10:15", "date_cours" => $nextFridayStr, "type_cours" => "TD"],
];
foreach ($creneaux as $creneau) {
    $stmt->bindParam(':matiere', $creneau['matiere']);
    $stmt->bindParam(':enseignant', $creneau['enseignant']);
    $stmt->bindParam(':salle', $creneau['salle']);
    $stmt->bindParam(':promotion', $creneau['promotion']);
    $stmt->bindParam(':departement', $creneau['departement']);
    $stmt->bindParam(':heure_debut', $creneau['heure_debut']);
    $stmt->bindParam(':heure_fin', $creneau['heure_fin']);
    $stmt->bindParam(':date_cours', $creneau['date_cours']);
    $stmt->bindParam(':type_cours', $creneau['type_cours']);
    $result = $stmt->execute();
    if (!$result) {
        echo "Erreur lors de l'insertion: ". $db->lastErrorMsg() . "<br>";
    } else {
        echo "Inséré avec succès.<br>";
    }
}

$db->close();
?>