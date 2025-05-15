<?php
$s = '<header>';
$s .= file_get_contents(ROOT . '/vue/component/navbar_admin.html');
$s .= '</header>
    <main>
    <div class="home-container">
        <h1 class="home-title">Bienvenue dans l\'administration</h1>
        <p class="home-description">Utilisez le menu pour naviguer entre les différentes sections.</p>
        <div class="home-stat-container">
            <h2 class="home-stat-title">Statistiques du jour</h2>
            <table class="home-stat-table">
                <thead>
                    <tr>
                        <th class="home-stat-header">Chiffre d\'affaires</th>
                        <th class="home-stat-header">Nombre de commandes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="home-stat-cell">##TOTAL_JOURNEE## €</td>
                        <td class="home-stat-cell">##NOMBRE_COMMANDES##</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </main>';

return $s;