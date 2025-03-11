

DROP DATABASE employe;
CREATE DATABASE employe;
USE employe;


CREATE TABLE employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    statut VARCHAR(255) NOT NULL,
    dateNaissance DATE NOT NULL,
    salaire DECIMAL(10, 2) NOT NULL
);



