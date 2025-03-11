<?php
// controllers/BlogController.php

require_once '../models/BlogModel.php';

class BlogController {
    private $model;

    public function __construct() {
        $this->model = new BlogModel();
    }

    // Liste tous les employes
    public function index() {
        $posts = $this->model->readAll();
        require '../views/blog/index.php';
    }

    




    


    // Créer un employe
    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $EMPLOYE_NOM = $_POST['EMPLOYE_NOM'];
            $EMPLOYE_STATUT = $_POST['EMPLOYE_STATUT'];
            $EMPLOYE_DATE_NAISSANCE = $_POST['EMPLOYE_DATE_NAISSANCE'];
            $EMPLOYE_SALAIRE = $_POST['EMPLOYE_SALAIRE'];

            $this->model->create($EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE);
            header("Location: ". ROOT_URL);
        } else {
            require '../views/blog/create.php';
        }
    }

    // Modifier un employe
    public function edit($EMPLOYE_ID) {
        $employe = $this->model->readByEMPLOYE_ID($EMPLOYE_ID);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $EMPLOYE_NOM = $_POST['EMPLOYE_NOM'];
            $EMPLOYE_STATUT = $_POST['EMPLOYE_STATUT'];
            $EMPLOYE_DATE_NAISSANCE = $_POST['EMPLOYE_DATE_NAISSANCE'];
            $EMPLOYE_SALAIRE = $_POST['EMPLOYE_SALAIRE'];
            $this->model->update($EMPLOYE_ID, $EMPLOYE_NOM, $EMPLOYE_STATUT, $EMPLOYE_DATE_NAISSANCE, $EMPLOYE_SALAIRE);
            header("Location: ". ROOT_URL);
        } else {
            require '../views/blog/edit.php';
        }
    }





    // Supprimer un employe
    public function delete($EMPLOYE_ID) {
        if (!isset($EMPLOYE_ID) || empty($EMPLOYE_ID)) {
            echo "Erreur ID";
            exit;
        }
        $this->model->delete($EMPLOYE_ID);
        header("Location: ". ROOT_URL);
    }
}
?>
