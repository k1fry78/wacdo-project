<?php
$s = '
<div class="payer-wrapper">
    <div class="payer-container">
        <div class="payer-commande-id">Numéro de commande : ' . $commande_id . '</div>
        <div class="payer-message">Récupérez le ticket avec votre numéro de commande</div>
        <div class="payer-message">Installez-vous</div>
        <div class="payer-message">On vous apporte la commande !</div>
        <div class="payer-message">La commande arrive dans un instant...</div>
        <a href="' . PROJET_DIR . '/accueil" class="payer-btn">Retour au menu</a>
    </div>
</div>';

return $s;
?>