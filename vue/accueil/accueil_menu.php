<?php

$s = '


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Food - Accueil</title>
</head>
<body>
<div class="categorie-container">';

foreach ($produits as $produit) {
    $s .= '<div class="categorie-card">';
    $s .= '<img src="' . PROJET_DIR . '/public/images/' . $produit->getImageFile() . '" alt="' . $produit->getNom() . '">';
    $s .= '<h3>' . $produit->getNom() . '</h3>';
    $s .= '<p>Prix: ' . $produit->getPrix() . '€</p>';
    $s .= '<form method="post" action="' . PROJET_DIR . '/commander/ajouterpanier">';
    $s .= '<input type="hidden" name="produit_id" value="' . $produit->getId() . '">';
    $s .= '<div class="categorie-form-group-inline">'; 
    $s .= '<div class="categorie-form-item">'; 
    $s .= '<label for="complement">Complément:</label>';
    $s .= '<select name="complement_id">';
    foreach ($complements as $complement) {
        $s .= '<option value="' . $complement->getNom() . '">' . $complement->getNom() . '</option>';
    }
    $s .= '</select>';
    $s .= '</div>';
    $s .= '<div class="categorie-form-item">'; 
    $s .= '<label for="boisson">Boisson:</label>';
    $s .= '<select name="boisson_id">';
    foreach ($boissons as $boisson) {
        $s .= '<option value="' . $boisson->getNom() . '">' . $boisson->getNom() . '</option>';
    }
    $s .= '</select>';
    $s .= '</div>';
    $s .= '<div class="categorie-form-item">'; 
    $s .= '<label for="quantite">Quantité:</label>';
    $s .= '<select name="quantite" id="quantite">';
    for ($i = 1; $i <= 10; $i++) {
        $s .= '<option value="' . $i . '">' . $i . '</option>';
    }
    $s .= '</select>';
    $s .= '</div>';
    $s .= '</div>'; 
    $s .= '<button type="submit" class="btn-ajouter">Ajouter au panier</button>';
    $s .= '</form>';
    $s .= '</div>';
}

$s .= '</div>
</body>
</html>';

return $s;
?>