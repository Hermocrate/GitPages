<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des employés</title>
</head>
<body>
    <h1>Gestion des employés</h1>

    <!-- Formulaire d'ajout d'employé -->
    <form id="employee-form">
        <label for="EMPLOYE_NOM">Nom</label>
        <input type="text" id="EMPLOYE_NOM" required>
        
        <label for="EMPLOYE_STATUT">Statut</label>
        <input type="text" id="EMPLOYE_STATUT" required>

        <label for="EMPLOYE_DATE_NAISSANCE">Date de naissance</label>
        <input type="date" id="EMPLOYE_DATE_NAISSANCE" required>

        <label for="EMPLOYE_SALAIRE">Salaire</label>
        <input type="number" id="EMPLOYE_SALAIRE" required>
        
        <button type="submit">Ajouter</button>
    </form>

    <hr>

    <!-- Liste employé ajouté récement dans le DOM-->
    <h2>Employés ajoutés récement</h2>
    <ul id="employee-list">
    </ul>

    <!-- Liste employés récupéré dans la BDD -->
    <h2>Liste des employés</h2>
    <ul id="complete-employee-list">
    </ul>

    <script defer src="http://localhost/run-php/competences-de-base-Hermocrate-main/public/js/script.js"></script>
    <script defer src="http://localhost/run-php/competences-de-base-Hermocrate-main/public/js/ajax.js"></script>
</body>
</html>
