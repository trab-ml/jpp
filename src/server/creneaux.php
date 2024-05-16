<?php
session_start();
require_once './check_auth.php';
require_once "./config_database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Creneau
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($creneau)
    {
        $stmt = $this->db->prepare("INSERT INTO creneaux(matiere, enseignant, salle, promotion, departement, heure_debut, heure_fin, date_cours, type_cours) VALUES (:matiere, :enseignant, :salle, :promotion, :departement, :heure_debut, :heure_fin, :date_cours, :type_cours)");
        $stmt->bindParam(':matiere', $creneau['matiere']);
        $stmt->bindParam(':salle', $creneau['salle']);
        $stmt->bindParam(':enseignant', $creneau['enseignant']);
        $stmt->bindParam(':type_cours', strtoupper($creneau['type_cours']));
        $stmt->bindParam(':promotion', $creneau['promotion']);
        $stmt->bindParam(':departement', $creneau['departement']);
        $stmt->bindParam(':heure_debut', $creneau['heure_debut']);
        $stmt->bindParam(':heure_fin', $creneau['heure_fin']);
        $stmt->bindParam(':date_cours', $creneau['date_cours']);
        $result = $stmt->execute();
        if (!$result) {
            $msg = "Erreur lors de l'insertion";
        } else {
            $msg = "Inséré avec succès";
        }
        return $msg;
    }

    public function delete($id)
    {
        $id = htmlspecialchars($id);
        $stmt = $this->db->prepare("DELETE FROM creneaux WHERE id_creneau = ?");
        $stmt->bindParam(1, $id);
        $result = $stmt->execute();
        if (!$result) {
            $msg = "Erreur lors de la suppression";
        } else {
            $msg = "Suppression effectuée avec succès";
        }
        return $msg;
    }
}

$creneau = new Creneau($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['to_delete']) && !empty($_GET['to_delete'])) {
            $msg = $creneau->delete($_GET['to_delete']);
            echo json_encode($msg);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !isset($data['matiere']) || empty($data['matiere'])
            || !isset($data['salle']) || empty($data['salle'])
            || !isset($data['enseignant']) || empty($data['enseignant'])
            || !isset($data['type_cours']) || empty($data['type_cours'])
            || !isset($data['promotion']) || empty($data['promotion'])
            || !isset($data['departement']) || empty($data['departement'])
            || !isset($data['heure_debut']) || empty($data['heure_debut'])
            || !isset($data['heure_fin']) || empty($data['heure_fin'])
            || !isset($data['date_cours']) || empty($data['date_cours'])
        ) {
            throw new InvalidArgumentException('Invalid input data');
        }
        $creneauData = [
            "matiere" => trim(htmlspecialchars($data['matiere'])),
            "salle" => trim(htmlspecialchars($data['salle'])),
            "enseignant" => trim(htmlspecialchars($data['enseignant'])),
            "type_cours" => trim(htmlspecialchars($data['type_cours'])),
            "promotion" => trim(htmlspecialchars($data['promotion'])),
            "departement" => trim(htmlspecialchars($data['departement'])),
            "heure_debut" => trim(htmlspecialchars($data['heure_debut'])),
            "heure_fin" => trim(htmlspecialchars($data['heure_fin'])),
            "date_cours" => trim(htmlspecialchars($data['date_cours'])),
        ];
        $msg = $creneau->create($creneauData);
        echo json_encode($msg);
        break;
    default:
        exit;
}