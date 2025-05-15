<?php
$s = '
<navbar>
    <div class="sidebar">
        <div class="links">
            <a href="' . PROJET_DIR . '/accueil" class="accueil">Accueil</a>';
foreach ($categories as $categorie) {
    $s .= '<a href="' . PROJET_DIR . '/accueil/' . strtolower($categorie->getNom()) . '">' . $categorie->getNom() . '</a>';
}
$s .= '</div>
        <a href="' . PROJET_DIR . '/accueil/deconnexion" class="deconnexion">Déconnexion</a>    
    </div>
</navbar>';

return $s;
