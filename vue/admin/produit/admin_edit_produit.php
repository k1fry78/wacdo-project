<?php
$s = '
<div class="edit-wrapper">
    <div class="edit-container">
        <h1>Modification du produit</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="edit-form-group">
                <label for="nom" class="edit-label">Nom</label>
                <input type="text" name="nom" class="edit-input" value="' . $produit->getNom() . '">
            </div>
            <div class="edit-form-group">
                <label for="prix" class="edit-label">Prix</label>
                <input type="text" name="prix" class="edit-input" value="' . $produit->getPrix() . '">
            </div>
            <div class="edit-form-group">
                <label for="categorie" class="edit-label">Catégorie</label>
                <select name="categorie" id="categorie" class="edit-select" required>
                    <option value="">Sélectionner une catégorie</option>';
foreach ($categories as $categorie) {
    $s .= '<option value="' . $categorie->getId() . '">' . $categorie->getNom() . '</option>';
}
$s .= '</select>
            </div>
            <div class="edit-form-group">
                <label for="description" class="edit-label">Description</label>
                <input type="text" name="description" class="edit-input" value="' . $produit->getDescription() . '">
            </div>
            <div class="edit-form-group">
                <label for="image" class="edit-label">Image</label>
                <input type="file" name="image" class="edit-input">
            </div>
            <input type="hidden" name="id" value="' . $produit->getId() . '">
            <button type="submit" class="edit-button-modify" name="submit" value="submit">Modifier</button>
            <a href="javascript:history.back()" class="edit-button-return">Retour</a>
        </form>
    </div>
</div>';

return $s;
?>