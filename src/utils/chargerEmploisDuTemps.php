<?php
// Connexion à la base de données
try {
    $db = new SQLite3('emploi_temps.db');
} catch (Exception $e) {
    echo json_encode(array('error' => 'Erreur lors de la connexion à la base de données.'));
    exit();
}

// Vérifier si la semaine est spécifiée
if (isset($_GET['semaine'])) {
    $semaine = $_GET['semaine'];

    // Requête SQL pour récupérer les emplois du temps pour la semaine spécifiée
    $query = "SELECT * FROM emplois_du_temps WHERE semaine = :semaine";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':semaine', $semaine, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Récupérer les données et les stocker dans un tableau
    $emploisDuTemps = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $emploisDuTemps[] = $row;
    }

    // Renvoyer les emplois du temps au format JSON
    echo json_encode($emploisDuTemps);
} else {
    echo json_encode(array('error' => 'Semaine non spécifiée.'));
}
?>
