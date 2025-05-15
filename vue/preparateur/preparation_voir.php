<?php

$s = '
<div class="voir-container">
    <h1 class="voir-title">Préparation de la commande n°' . $commande_id . '</h1>
    <a href="' . PROJET_DIR . '/preparateur" class="voir-button-retour">Retour à la liste des commandes à préparer</a>
    <table class="voir-table">
        <thead class="voir-table__header">
            <tr>
                <th class="voir-table__header-cell">Les produits à préparer</th>
                <th class="voir-table__header-cell">Détails</th>
                <th class="voir-table__header-cell">Prix</th>
                <th class="voir-table__header-cell">Quantité</th>
            </tr>
        </thead>
        <tbody class="voir-table__body">';

if (count($commandeProduits) == 0) {
    $s .= "<tr><td colspan='4' class='voir-table__empty'>Aucune commande enregistrée</td></tr>";
} else {
    $produits = new Produit();
    $produits = $produits->getAllProduits();
    $produitsMap = [];
    foreach ($produits as $produit) {
        $produitsMap[$produit->getId()]['nom'] = $produit->getNom();
        $produitsMap[$produit->getId()]['prix'] = $produit->getPrix();
    }
    $totalPrix = 0;
    foreach ($commandeProduits as $commandeProduit) {
        $s .= '<tr class="voir-table__row">';
        $produitID = $commandeProduit->getProduit_id();
        $commandeProduitNom = isset($produitsMap[$produitID]['nom']) ? $produitsMap[$produitID]['nom'] : 0;
        $s .= '<td class="voir-table__cell">' . $commandeProduitNom . '</td>';
        $s .= '<td class="voir-table__cell">' . $commandeProduit->getDetails() . '</td>';
        $commandeProduitPrix = isset($produitsMap[$produitID]['prix']) ? $produitsMap[$produitID]['prix'] : 0;
        $s .= '<td class="voir-table__cell">' . $commandeProduitPrix . '€</td>';
        $s .= '<td class="voir-table__cell">' . $commandeProduit->getQuantite() . '</td>';
        $s .= '</tr>';
        $totalPrix += $commandeProduitPrix * $commandeProduit->getQuantite();
    }
}
$s .= '</tbody>
    </table>
    <form action="http://localhost/wacdo-project/preparation/pret" method="post" class="voir-form">
        <input type="hidden" name="commande_id" value="' . $commande_id . '">
        <button type="submit" class="voir-button-pret">Marquer comme Prête</button>
    </form>
</div>';

return $s;
?>