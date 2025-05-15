<?php
$s = '
<div class="edit-wrapper">
    <div class="edit-container">
        <h1>Modification de la catégorie</h1>
        <form action="" method="post">
            <div class="edit-form-group">
                <label for="nom" class="edit-label">Nom</label>
                <input type="text" name="nom" class="edit-input" value="' . $categorie->getNom() . '">
            </div>
            <div class="edit-form-group">
                <label for="image" class="edit-label">Image</label>
                <input type="file" name="image" class="edit-input" value="' . $categorie->getImage() . '">
            </div>
            <input type="hidden" name="id" value="' . $categorie->getId() . '">
            <button type="submit" class="edit-button-modify" name="submit" value="submit">Modifier</button>
            <a href="javascript:history.back()" class="edit-button-return">Retour</a>
        </form>
    </div>
</div>';

return $s;
?>