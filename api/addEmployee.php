<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//https://chatgpt.com/share/67cde174-957c-8008-8fb8-68e086795fa2
header("Access-Control-Allow-Origin: https://localhost");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Autoriser les requêtes OPTIONS pour le pré-vol CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once '../config/Database.php';
require_once '../models/Employee.php';

try {
    $database = Database::getInstance(); 
    $db = $database;

    // Récupération des données JSON
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception("Données JSON invalides.");
    }

    if (empty($data['nom']) || empty($data['statut']) || empty($data['dateNaissance']) || empty($data['salaire'])) {
        throw new Exception("Tous les champs sont obligatoires.");
    }

    // Création de l'employé
    $employee = new Employee($db);
    $employee->nom = $data['nom'];
    $employee->statut = $data['statut'];
    $employee->dateNaissance = $data['dateNaissance'];
    $employee->salaire = $data['salaire'];

    // Insertion dans la base de données
    if ($employee->create()) {
        echo json_encode(['success' => true, 'message' => 'Employé ajouté avec succès.']);
    } else {
        throw new Exception("Erreur lors de l'ajout de l'employé.");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}