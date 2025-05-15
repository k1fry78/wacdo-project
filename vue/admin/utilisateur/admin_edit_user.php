<?php
$s = '
<div class="edit-wrapper">
    <div class="edit-container">
        <h1>Modification de l\'utilisateur</h1>
        <form action="" method="post">
            <div class="edit-form-group">
                <label for="nom" class="edit-label">Nom</label>
                <input type="text" name="nom" class="edit-input" value="' . $user->getNom() . '">
            </div>
            <div class="edit-form-group">
                <label for="prenom" class="edit-label">Prénom</label>
                <input type="text" name="prenom" class="edit-input" value="' . $user->getPrenom() . '">
            </div>
            <div class="edit-form-group">
                <label for="email" class="edit-label">Email</label>
                <input type="email" name="email" class="edit-input" value="' . $user->getEmail() . '">
            </div>
            <div class="edit-form-group">
                <label for="role" class="edit-label">Rôle</label>
                <select class="edit-select" name="role" required>
                    <option selected>Sélectionner un rôle</option>';
if ($user->getRole() == "ROLE_ADMIN") {
    $s .= '<option value="ROLE_ADMIN" selected>ROLE_ADMIN</option>';
} else {
    $s .= '<option value="ROLE_ADMIN">ROLE_ADMIN</option>';
}
if ($user->getRole() == "ROLE_ACCUEIL") {
    $s .= '<option value="ROLE_ACCUEIL" selected>ROLE_ACCUEIL</option>';
} else {
    $s .= '<option value="ROLE_ACCUEIL">ROLE_ACCUEIL</option>';
}
if ($user->getRole() == "ROLE_PREPARATEUR") {
    $s .= '<option value="ROLE_PREPARATEUR" selected>ROLE_PREPARATEUR</option>';
} else {
    $s .= '<option value="ROLE_PREPARATEUR">ROLE_PREPARATEUR</option>';
}
$s .= '                </select>
            </div>
            <input type="hidden" name="id" value="' . $user->getId() . '">
            <br>
            <button type="submit" class="edit-button-modify" name="submit" value="submit">Modifier</button>
            <a href="javascript:history.back()" class="edit-button-return">Retour</a>
        </form>
    </div>
</div>
';

return $s;
?>