<?php
$s = '<header>';
$s .= file_get_contents(ROOT . "/vue/component/navbar_admin.html");
$s .= '</header>
<div class="list-container">
    <h1 class="list-title">Liste des utilisateurs</h1>
    <a href="' . PROJET_DIR . '/admin" class="list-button-return">Retour au menu administrateur</a>
    <a href="' . PROJET_DIR . '/admin/utilisateur/nouveau" class="list-button-add">Nouvel utilisateur</a>
    <table class="list-table">
        <thead class="list-table__header">
            <tr>
                <th class="list-table__header-cell">Nom</th>
                <th class="list-table__header-cell">Prénom</th>
                <th class="list-table__header-cell">Email</th>
                <th class="list-table__header-cell">Rôle</th>
                <th class="list-table__header-cell">Actions</th>
            </tr>
        </thead>
        <tbody class="list-table__body">';

if (count($users) == 0) {
    $s .= "<tr><td colspan='5' class='list-table__empty'>Aucun utilisateur enregistré</td></tr>";
} else {
    foreach ($users as $user) {
        $s .= '<tr class="list-table__row">';
        $s .= '<td class="list-table__cell">' . $user->getNom() . '</td>';
        $s .= '<td class="list-table__cell">' . $user->getPrenom() . '</td>';
        $s .= '<td class="list-table__cell">' . $user->getEmail() . '</td>';
        $s .= '<td class="list-table__cell">' . $user->getRole() . '</td>';
        $s .= '<td class="list-table__cell">
                    <a href="' . PROJET_DIR . '/admin/utilisateur/delete/' . $user->getId() . '">
                        <svg style="width: 20px; height: 20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                        </svg>
                    </a>
                    <a href="' . PROJET_DIR . '/admin/utilisateur/edit/' . $user->getId() . '">
                        <svg style="width: 20px; height: 20px; margin-left: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </a>
                </td>';
        $s .= '</tr>';
    }
}
$s .= '</tbody>
         </table>
         </div>';

return $s;
?>