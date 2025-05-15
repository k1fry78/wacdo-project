<?php
$s = '
<div class="panier-container">
    <h1>Votre commande</h1>
    <table class="panier-table">
    <thead class="panier-table__header">
        <tr>
            <th class="panier-table__header-cell">Vos produits</th>
            <th class="panier-table__header-cell">Détails</th>
            <th class="panier-table__header-cell">Prix</th>
            <th class="panier-table__header-cell">Quantité</th>
            <th class="panier-table__header-cell">Total</th>
            <th class="panier-table__header-cell">Actions</th>
        </tr>
    </thead>
    <tbody class="panier-table__body">';
$totalPrix = 0;
if (count($commandeProduits) == 0) {
    $s .= "<tr><td colspan='5' class='panier-table__empty'>Aucune commande enregistrée</td></tr>";
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
        $s .= '<tr class="panier-table__row">';
        $produitID = $commandeProduit->getProduit_id();
        $commandeProduitNom = isset($produitsMap[$produitID]['nom']) ? $produitsMap[$produitID]['nom'] : 'Produit inconnu';
        $commandeProduitDetails = $commandeProduit->getDetails();
        $commandeProduitPrix = isset($produitsMap[$produitID]['prix']) ? $produitsMap[$produitID]['prix'] : 0;
        $quantite = $commandeProduit->getQuantite();
        $totalLigne = $commandeProduitPrix * $quantite;

        $s .= '<td class="panier-table__cell">' . $commandeProduitNom . '</td>';
        $s .= '<td class="panier-table__cell">' . $commandeProduitDetails . '</td>';
        $s .= '<td class="panier-table__cell">' . $commandeProduitPrix . '€</td>';
        $s .= '<td class="panier-table__cell">' . $quantite . '</td>';
        $s .= '<td class="panier-table__cell">' . $totalLigne . '€</td>';
        $s .= '<td class="panier-table__cell"><a href=" ' . PROJET_DIR . '/accueil/panier/supprimer/' . $commandeProduit->getId() . '" class="panier-table__delete"><svg style="width: 20px; height: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a></td>';
        $s .= '</tr>';

        $totalPrix += $totalLigne;
    }
}
$s .= '</tbody>
     </table>
     <div class="panier-total">
        <table class="panier-total__table">
            <tr>
                <th class="panier-total__label">Total</th>
                <td class="panier-total__value">' . $totalPrix . '€</td> <!-- Afficher le total général -->
            </tr>
        </table>
        <form action="' . PROJET_DIR . '/accueil/panier/payer" method="post" class="panier-total__form">
            <input type="hidden" name="totalPrix" value="' . $totalPrix . '">
            <button type="submit" class="panier-total__button">Payer</button>
        </form>
     </div>
     </div>
    </main>';

return $s;
