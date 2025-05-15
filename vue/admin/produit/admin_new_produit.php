<?php
$s = '
<main>
<div class="new-wrapper">
    <div class="new-container">
        <h1>Nouveau produit</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="new-form-group">
                <label for="nom" class="new-label">Nom</label>
                <input type="text" name="nom" id="nom" class="new-input">
            </div>
            <div class="new-form-group">
                <label for="prix" class="new-label">Prix</label>
                <input type="text" name="prix" id="prix" class="new-input">
            </div>
            <div class="new-form-group">
                <label for="categorie" class="new-label">Catégorie</label>
                <select name="categorie" id="categorie" class="new-select" required>
                    <option value="">Sélectionner une catégorie</option>';
foreach ($categories as $categorie) {
    $s .= '<option value="' . $categorie->getId() . '">' . $categorie->getNom() . '</option>';
}
$s .= '</select>
            </div>
            <div class="new-form-group">
                <label for="description" class="new-label">Description</label>
                <input type="text" name="description" id="description" class="new-input">
            </div> 
            <div class="new-form-group">
                <label for="image" class="new-label">Image</label>
                <input type="file" name="image" id="image" class="new-input">
            </div>
            <button type="submit" class="new-button-add" name="submit" value="submit">Ajouter</button>
            <a href="javascript:history.back()" class="new-button-return">Retour</a> 
        </form>
    </div>
</div>
</main>';

return $s;
?>