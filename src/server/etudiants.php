<?php
session_start();
require_once './check_auth.php';
require_once "./config_database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Etudiant
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($nom, $promotion, $departement, $mot_de_passe, $date_inscription)
    {
        $nom = htmlspecialchars($nom);
        $promotion = htmlspecialchars(strtoupper($promotion));
        $departement = htmlspecialchars(strtoupper($departement));
        $mot_de_passe = htmlspecialchars($mot_de_passe);
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $date_inscription = htmlspecialchars($date_inscription);

        $stmt = $this->db->prepare("INSERT INTO etudiants (nom, promotion, departement, mot_de_passe, date_inscription) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $promotion);
        $stmt->bindParam(3, $departement);
        $stmt->bindParam(4, $mot_de_passe_hash);
        $stmt->bindParam(5, $date_inscription);
        return $stmt->execute();
    }

    public function read($id_etudiant = null)
    {
        if ($id_etudiant && !empty($id_etudiant)) {
            $id_etudiant = htmlspecialchars($id_etudiant);
            $stmt = $this->db->prepare("SELECT id_etudiant AS id, nom, departement FROM etudiants WHERE id_etudiant = ?");
            $stmt->bindParam(1, $id_etudiant);
            $result = $stmt->execute();
            return $result->fetchArray(SQLITE3_ASSOC);
        } else {
            $result = $this->db->query("SELECT id_etudiant AS id, nom, departement FROM etudiants");
            $data = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function update($id_etudiant, $nom, $promotion, $departement, $mot_de_passe, $date_inscription)
    {
        $id_etudiant = filter_var($id_etudiant, FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $promotion = filter_var($promotion, FILTER_SANITIZE_NUMBER_INT);
        $departement = filter_var($departement, FILTER_SANITIZE_STRING);
        $mot_de_passe = filter_var($mot_de_passe, FILTER_SANITIZE_STRING);
        $date_inscription = filter_var($date_inscription, FILTER_SANITIZE_STRING);

        if (!is_numeric($id_etudiant) || !is_string($nom) || !is_numeric($promotion) || !is_string($departement) || !is_string($mot_de_passe) || !is_string($date_inscription)) {
            throw new InvalidArgumentException('Invalid input data');
        }

        $stmt = $this->db->prepare("UPDATE etudiants SET nom = ?, promotion = ?, departement = ?, mot_de_passe = ?, date_inscription = ? WHERE id_etudiant = ?");
        return $stmt->execute([$nom, $promotion, $departement, $mot_de_passe, $date_inscription, $id_etudiant]);
    }

    public function delete($id_etudiant)
    {
        $id_etudiant = htmlspecialchars($id_etudiant);
        $stmt = $this->db->prepare("DELETE FROM etudiants WHERE id_etudiant = ?");
        $stmt->bindParam(1, $id_etudiant);
        return $stmt->execute();
    }
}

$etudiant = new Etudiant($db);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            !isset($data['nom']) || empty($data['nom'])
            || !isset($data['promotion']) || empty($data['promotion'])
            || !isset($data['departement']) || empty($data['departement'])
            || !isset($data['mot_de_passe']) || empty($data['mot_de_passe'])
            || !isset($data['date_inscription']) || empty($data['date_inscription'])
        ) {
            throw new InvalidArgumentException('Invalid input data');
        }

        $nom = $data['nom'];
        $promotion = $data['promotion'];
        $departement = $data['departement'];
        $mot_de_passe = $data['mot_de_passe'];
        $date_inscription = $data['date_inscription'];
        $id = $etudiant->create($nom, $promotion, $departement, $mot_de_passe, $date_inscription);
        echo json_encode($id);
        break;
    case 'GET':
        if (isset($_GET['to_delete']) && !empty($_GET['to_delete'])) {
            echo json_encode(['success' => $etudiant->delete($_GET['to_delete'])]);
        } else {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            echo json_encode($etudiant->read($id));
        }
        break;
    case 'PUT':
        // NOT TESTED
        parse_str(file_get_contents("php://input"), $post_vars);
        echo json_encode(['success' => $etudiant->update($post_vars['id_etudiant'], $post_vars['nom'], $post_vars['promotion'], $post_vars['departement'], $post_vars['mot_de_passe'], $post_vars['date_inscription'])]);
        break;
    default:
        exit;
}
?>