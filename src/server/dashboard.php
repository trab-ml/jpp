<?php

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require_once './check_auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/dashboardStyle.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/fetchEtudiants.js"></script>
    <script src="../js/fetchCreneaux.js"></script>
</head>

<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="menu">
                <button type="button" id="btn-etudiant">Etudiants</button>
                <button type="button" id="btn-enseignant">Enseignants</button>
                <button type="button" id="btn-creneau">Creneaux</button>
                <button type="button" id="btn-salle">Salles</button>
            </div>
            <div class="content"></div>
        </div>
    </div>
</body>

</html>