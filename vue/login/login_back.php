<?php
$s = '<div class="cookie-popup" id="cookie-popup">
    <div class="cookie-popup-content">
        <p>Nous utilisons des cookies pour améliorer votre expérience. En continuant, vous acceptez notre <a href="confidentialite">politique de confidentialité</a>.</p>
        <div class="cookie-popup-actions">
            <button id="accept-cookies" class="cookie-popup-button">Accepter</button>
            <button id="refuse-cookies" class="cookie-popup-button refuse">Refuser</button>
        </div>
    </div>
</div>

    <div class="login-container">
        <h2>Connexion</h2>
    <form method="post" action="">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Se souvenir de moi</label>
    </div>
    <button type="submit" name="submit">Se connecter</button>';
$s .= '<p style="color:red;">' . $errorMessage . '</p>';
$s .= '</form>    
    </div>
    
<style>

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #c94d01;
}
.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.login-container h2 {
    margin-bottom: 20px;
}
.login-container input {
    width: 80%;
    padding: 10px;
    margin: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.remember-me {
    display: flex; /* Aligne les éléments horizontalement */
    align-items: center; /* Centre verticalement la case à cocher et le label */
    justify-content: flex-start; /* Aligne les éléments à gauche */
    margin: 10px 0; /* Ajoute un espace autour */
     width: 80%;
}
.remember-me input[type="checkbox"] {
    margin-right: 0; 
}
.remember-me label {
    width: 100%;
}
.login-container button {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.login-container button:hover {
    background-color: #ff4500;
}
.cookie-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); 
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Place le popup au-dessus de tout */
}

/* Contenu du popup */
.cookie-popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width: 90%;
    max-width: 400px;
}

/* Texte du popup */
.cookie-popup-content p {
    margin-bottom: 20px;
    font-size: 16px;
    color: #333;
}

/* Boutons du popup */
.cookie-popup-actions {
    display: flex;
    justify-content: space-around;
}

.cookie-popup-button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #fff;
    background-color: #007bff;
}

.cookie-popup-button:hover {
    background-color: #0056b3;
}

.cookie-popup-button.refuse {
    background-color: #d9534f;
}

.cookie-popup-button.refuse:hover {
    background-color: #c9302c;
}

body.popup-active {
    overflow: hidden;
}
</style>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.getElementById("cookie-popup");
        const acceptButton = document.getElementById("accept-cookies");
        const refuseButton = document.getElementById("refuse-cookies");
        const loginButton = document.querySelector("button[name=\'submit\']");

        document.body.classList.add("popup-active");
        loginButton.disabled = true;

        acceptButton.addEventListener("click", function () {
            document.cookie = "cookies_accepted=true; path=/; max-age=" + 60 * 60 * 24 * 30;
            cookiePopup.style.display = "none";
            document.body.classList.remove("popup-active");
            loginButton.disabled = false;
        });

        refuseButton.addEventListener("click", function () {
            document.cookie = "cookies_accepted=false; path=/; max-age=" + 60 * 60 * 24 * 30;
            cookiePopup.style.display = "none";
            document.body.classList.remove("popup-active");
            loginButton.disabled = false;
        });
    });
</script>';

return $s;
