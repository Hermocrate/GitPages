<!-- views/blog/edit.php -->
<h1>Modifier l'employe</h1>
<form action="<?php URL_EDIT_BLOGPOST . '&id=' . $post['id']; ?>" method="POST">
<label for="nom">Nom</label>
    <input type="text" name="EMPLOYE_NOM" value="<?= htmlspecialchars($employe['EMPLOYE_NOM']); ?>" required>

    <label for="statut">Statut</label>
    <input type="text" name="EMPLOYE_STATUT" value="<?= htmlspecialchars($employe['EMPLOYE_STATUT']); ?>" required>

    <label for="date_naissance">Date de naissance</label>
    <input type="text" name="EMPLOYE_DATE_NAISSANCE" value="<?= htmlspecialchars($employe['EMPLOYE_DATE_NAISSANCE']); ?>" required>

    <label for="salaire">Salaire</label>
    <input type="text" name="EMPLOYE_SALAIRE" value="<?= htmlspecialchars($employe['EMPLOYE_SALAIRE']); ?>" required>

    <button type="submit">Modifier</button>
</form>
