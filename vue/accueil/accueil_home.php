<?php

$s = '
<div class="home-container">
    <div>
        <h1>Bienvenue chez Wac Do</h1>
        <form action="/wacdo-project/accueil" method="post">
            <input type="hidden" name="action" value="commander">
            <button type="submit">Création d\'une nouvelle commande</button>
        </form>';

if (isset($message)) {
    $s .= '<p>' . $message . '</p>';
}

$s .= '<div class="home-container-liste">
<table>
    <thead>
        <tr>
            <th>Numéro de commande</th>
            <th>Prix Total</th>
            <th>Date de la commande</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>';

if (isset($collection) && count($collection) == 0) {
    $s .= "<tr><td colspan='4'>Aucune commande enregistrée</td></tr>";
} elseif (isset($collection)) {
    foreach ($collection as $commande) {
        $s .= '<tr>';
        $s .= '<td>' . $commande->getId() . '</td>';
        $s .= '<td>' . $commande->getPrix() . '€</td>';
        $s .= '<td>' . $commande->getDate() . '</td>';
        $s .= '<td>' . $commande->getStatut() . '</td>';
        $s .= '<td>
                <form action="/wacdo-project/accueil/delivrer" method="post" style="display:inline;">
                    <input type="hidden" name="commande_id" value="' . $commande->getId() . '">
                    <button type="submit">Commande délivrée</button>
                </form>
                <form action="/wacdo-project/accueil/annuler" method="post" style="display:inline;">
                    <input type="hidden" name="commande_id" value="' . $commande->getId() . '">
                    <button type="submit">Annuler</button>
                </form>
                </td>';
        $s .= '</tr>';
    }
}

$s .= '</tbody>
         </table>
         </div>
    </div>
</div>';

return $s;
