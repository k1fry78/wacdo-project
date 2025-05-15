<?php
$s = '<header>';
$s .= file_get_contents(ROOT . "/vue/component/navbar_admin.html");
$s .= '</header>
<main>
<div class="list-container">
    <h1 class="list-title">Liste des commandes</h1>
    <a href="' . PROJET_DIR . '/admin" class="list-button-return">Retour au menu administrateur</a>
    <a href="' . PROJET_DIR . '/admin/commande/suppression" class="list-button-delete">Supprimer les commandes vides</a>
    <table class="list-table">
        <thead class="list-table__header">
            <tr>
                <th class="list-table__header-cell">Numéro de commande</th>
                <th class="list-table__header-cell">Prix Total</th>
                <th class="list-table__header-cell">Date de la commande</th>
                <th class="list-table__header-cell">Statut</th>
                <th class="list-table__header-cell">Actions</th>
            </tr>
        </thead>
        <tbody class="list-table__body">';

if (count($commandes) == 0) {
    $s .= "<tr><td colspan='5' class='list-table__empty'>Aucune commande enregistrée</td></tr>";
} else {
    foreach ($commandes as $commande) {
        $s .= '<tr class="list-table__row">';
        $s .= '<td class="list-table__cell">' . $commande->getId() . '</td>';
        $s .= '<td class="list-table__cell">' . $commande->getPrix() . '€</td>';
        $s .= '<td class="list-table__cell">' . $commande->getDate() . '</td>';
        $s .= '<td class="list-table__cell">' . $commande->getStatut() . '</td>';
        $s .= '<td class="list-table__cell">
                    <a href="' . PROJET_DIR . '/admin/commande/delete/' . $commande->getId() . '">
                        <svg style="width: 20px; height: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </a>
                </td>';
        $s .= '</tr>';
    }
}
$s .= '</tbody>
    </table>
</div>
</main>';

return $s;
?>