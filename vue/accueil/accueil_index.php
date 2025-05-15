<?php
$s='<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WacDo</title>
</head>
<body>
    <header>';
    if (isset($_SESSION['message'])) {
        echo '<div class="index-alert-message">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); 
    }
    $s.= require_once(ROOT. '/vue/component/navbar_accueil.php');
    $s .= file_get_contents(ROOT. '/vue/component/panier.html');
    $s.='</header>';
    $s .= '
<main>
##CONTENT##
</main>
    <footer style="position: fixed; bottom: 10px; right: 10px; text-align: right; font-size: 14px;">
    <a href="' . PROJET_DIR . '/politique-confidentialite" style="text-decoration: none; color: #000;">Politique de confidentialité</a> |
    <a href="' . PROJET_DIR . '/donnees-personnelles" style="text-decoration: none; color: #000;">Données personnelles</a>
</footer>
<link rel="stylesheet" href="' . PROJET_DIR . '/public/css/style_accueil.css">
</body>
</html>';


return $s;
?>