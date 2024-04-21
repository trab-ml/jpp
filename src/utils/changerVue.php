<?php
// Vérifier si la vue est spécifiée
if (isset($_GET['vue'])) {
    $vue = $_GET['vue'];

    // En fonction de la vue sélectionnée, charger le fichier HTML approprié
    if ($vue == 'liste') {
        include('emplois_du_temps_liste.html');
    } elseif ($vue == 'semainier') {
        include('emplois_du_temps_semainier.html');
    } else {
        echo json_encode(array('error' => 'Vue invalide.'));
    }
} else {
    echo json_encode(array('error' => 'Vue non spécifiée.'));
}
?>
