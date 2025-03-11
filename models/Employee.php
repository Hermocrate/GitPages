<?php
class Employee {
    private $conn;
    private $table = 'employes';

    public $id;
    public $nom;
    public $statut;
    public $dateNaissance;
    public $salaire;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (nom, statut, dateNaissance, salaire) VALUES (:nom, :statut, :dateNaissance, :salaire)';
        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->statut = htmlspecialchars(strip_tags($this->statut));
        $this->dateNaissance = htmlspecialchars(strip_tags($this->dateNaissance));
        $this->salaire = htmlspecialchars(strip_tags($this->salaire));

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->bindParam(':dateNaissance', $this->dateNaissance);
        $stmt->bindParam(':salaire', $this->salaire);

        if ($stmt->execute()) {
            return true;
        }

        error_log("Erreur SQL : " . print_r($stmt->errorInfo(), true));
        return false;
    }

    public function readAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}