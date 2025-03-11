<?php
// models/BlogModel.php

require_once '../config/Database.php';

class BlogModel {
    private $conn;
    private $table = "EMPLOYE_LISTE";

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // Créer un nouveau employe
    public function create($EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE) {
        $errors = $this->validateData($EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE);
    
        if (count($errors) > 0) {
            return $errors;
        }else{
    
        $query = "INSERT INTO " . $this->table . "(EMPLOYE_NOM, EMPLOYE_STATUT, EMPLOYE_DATE_NAISSANCE, EMPLOYE_SALAIRE) 
            VALUES (:EMPLOYE_NOM, :EMPLOYE_STATUT, :EMPLOYE_DATE_NAISSANCE, :EMPLOYE_SALAIRE)";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":EMPLOYE_NOM", $EMPLOYE_NOM);
        $stmt->bindParam(":EMPLOYE_STATUT", $EMPLOYE_STATUT);
        $stmt->bindParam(":EMPLOYE_DATE_NAISSANCE", $EMPLOYE_DATE_NAISSANCE);
        $stmt->bindParam(":EMPLOYE_SALAIRE", $EMPLOYE_SALAIRE);
    
        return $stmt->execute();
        }
    }
    
    private function validateData($EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE) {
        $errors = [];
    
        if (empty($EMPLOYE_NOM)) {
            $errors[] = "Le nom de l'employé est requis.";
        }
    
        if (empty($EMPLOYE_STATUT)) {
            $errors[] = "Le statut de l'employé est requis.";
        }
    
        if (empty($EMPLOYE_DATE_NAISSANCE)) {
            $errors[] = "La date de naissance est requise.";
        } else {
            $timestamp = strtotime($EMPLOYE_DATE_NAISSANCE);
            if (!$timestamp) {
                $errors[] = "La date de naissance doit être valide.";
            } elseif (date('Y-m-d', $timestamp) !== $EMPLOYE_DATE_NAISSANCE) {
                $errors[] = "La date de naissance doit être au format AAAA-MM-JJ.";
            }
        }
    
        if (empty($EMPLOYE_SALAIRE)) {
            $errors[] = "Le salaire est requis.";
        } elseif (!is_numeric($EMPLOYE_SALAIRE) || $EMPLOYE_SALAIRE <= 0) {
            $errors[] = "Le salaire doit être un nombre positif.";
        }
    
        return $errors;
    }
    
    

    // Lire tous les employes
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY EMPLOYE_ID DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire un employe par ID
    public function readByEMPLOYE_ID($EMPLOYE_ID) {
        $query = "SELECT * FROM " . $this->table . " WHERE EMPLOYE_ID = :EMPLOYE_ID LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":EMPLOYE_ID", $EMPLOYE_ID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? $result : null;
    }

    // Mettre à jour un employe
    public function update($EMPLOYE_ID, $EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE) {

        $errors = $this->validateData($EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE);
    

        if (count($errors) > 0) {
            return $errors;
        }
    

        $query = "UPDATE " . $this->table . " SET 
                      EMPLOYE_NOM = :EMPLOYE_NOM, 
                      EMPLOYE_STATUT = :EMPLOYE_STATUT, 
                      EMPLOYE_DATE_NAISSANCE = :EMPLOYE_DATE_NAISSANCE, 
                      EMPLOYE_SALAIRE = :EMPLOYE_SALAIRE 
                  WHERE EMPLOYE_ID = :EMPLOYE_ID";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":EMPLOYE_NOM", $EMPLOYE_NOM);
        $stmt->bindParam(":EMPLOYE_STATUT", $EMPLOYE_STATUT);
        $stmt->bindParam(":EMPLOYE_DATE_NAISSANCE", $EMPLOYE_DATE_NAISSANCE);
        $stmt->bindParam(":EMPLOYE_SALAIRE", $EMPLOYE_SALAIRE);
        $stmt->bindParam(":EMPLOYE_ID", $EMPLOYE_ID);
    
        return $stmt->execute();
    }
    

    


    // Supprimer un employe
    public function delete($EMPLOYE_ID) {
        $query = "DELETE FROM " . $this->table . " WHERE EMPLOYE_ID = :EMPLOYE_ID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":EMPLOYE_ID", $EMPLOYE_ID);
        return $stmt->execute();
    }

}
?>
