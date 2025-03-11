<?php
//https://chatgpt.com/share/67cde174-957c-8008-8fb8-68e086795fa2
header("Access-Control-Allow-Origin: https://localhost");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once '../config/Database.php';
require_once '../models/Employee.php';

try {

    $database = Database::getInstance();
    $db = $database;


    $employee = new Employee($db);
    $employees = $employee->readAll();


    echo json_encode(['success' => true, 'employees' => $employees]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}