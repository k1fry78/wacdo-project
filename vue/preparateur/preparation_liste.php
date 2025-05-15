<?php

$s = '
<div class="liste-container">
    <h1 class="liste-title">Les commandes à préparer</h1>
    <table class="liste-table">
        <thead class="liste-table__header">
            <tr>
                <th class="liste-table__header-cell">Numéro de commande</th>
                <th class="liste-table__header-cell">Prix Total</th>
                <th class="liste-table__header-cell">Date de la commande</th>
                <th class="liste-table__header-cell">Statut</th>
                <th class="liste-table__header-cell">Actions</th>
            </tr>
        </thead>
        <tbody class="liste-table__body">';

if (count($commandes) == 0) {
    $s .= "<tr><td colspan='5' class='liste-table__empty'>Aucune commande enregistrée</td></tr>";
} else {
    foreach ($commandes as $commande) {
        $s .= '<tr class="liste-table__row">';
        $s .= '<td class="liste-table__cell">' . $commande->getId() . '</td>';
        $s .= '<td class="liste-table__cell">' . $commande->getPrix() . '€</td>';
        $s .= '<td class="liste-table__cell">' . $commande->getDate() . '</td>';
        $s .= '<td class="liste-table__cell">' . $commande->getStatut() . '</td>';
        $s .= '<td class="liste-table__cell"><a href="' . PROJET_DIR . '/preparateur/voir/' . $commande->getId() . '" class="liste-table__action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height:30px; width:30px;"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></a></td>';
        $s .= '</tr>';
    }
}
$s .= '</tbody>
    </table>
    <a href="' . PROJET_DIR . '/preparateur/deconnexion" class="liste-button-deconnexion">Déconnexion</a>
</div>';

return $s;
?>