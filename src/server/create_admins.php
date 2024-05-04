<?php
require_once "./config_database.php";

$sql = 'INSERT INTO administratifs(nom, mot_de_passe, date_creation) VALUES (:nom, :mot_de_passe, :date_creation)';
$stmt = $db->prepare($sql);

$users = [
    ["nom" => "John Dupont", "mot_de_passe" => "jd24*", "date_creation" => date("Y-m-d")],
    ["nom" => "Alice Smith", "mot_de_passe" => "as23!", "date_creation" => date("Y-m-d")],
    ["nom" => "Bob Johnson", "mot_de_passe" => "bj45#", "date_creation" => date("Y-m-d")]
];

foreach ($users as $user) {
    $stmt->bindParam(':nom', $user['nom']);
    $hashed_password = password_hash($user['mot_de_passe'], PASSWORD_DEFAULT);
    $stmt->bindParam(':mot_de_passe', $hashed_password);
    $stmt->bindParam(':date_creation', $user['date_creation']);

    $result = $stmt->execute();

    if (!$result) {
        echo "Erreur lors de l'insertion de l'utilisateur: " . $user['nom'] . "<br>" . $db->lastErrorMsg() . "<br><br>";
    } else {
        echo "Compte utilisateur, " . $user['nom'] . ", créé avec succès.<br>";
    }
}

$db->close();
?>