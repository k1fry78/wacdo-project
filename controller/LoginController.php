<?php
class LoginController extends AdminAbstractController
{

    public function __construct(string $url)
    {
        parent::__construct();

        $url = explode("/", $url);
        array_shift($url);
        if (empty($url[1])) {
            $this->login();
        } else {
            switch ($url[1]) {
                case 'confidentialite':
                    $this->confidentialite();
                    break;
          }
    }
}


    public function login()
    {
        $email = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : "";
        $password = isset($_COOKIE['user_password']) ? $_COOKIE['user_password'] : "";
        $errorMessage = ""; // Variable pour stocker le message d'erreur
    
        if (isset($_POST['submit'])) {
            $sql = "SELECT * FROM utilisateur WHERE user_email = :email";
            $req = $this->connexion->prepare($sql);
            $req->execute(array(
                "email" => $_POST['email']
            ));
            $user = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                if (password_verify($_POST['password'], $user['user_password'])) {
                    // Mot de passe correct
                    if (isset($_POST['remember'])) {
                        setcookie('user_email', $user['user_email'], time() + 3600 * 24 * 30);
                        setcookie('user_password', $_POST['password'], time() + 3600 * 24 * 30);
                    }
                    $_SESSION['user'] = $user;
    
                    // Redirection en fonction du rôle
                    if ($user['user_role'] == "ROLE_ADMIN") {
                        header('Location: ' . PROJET_DIR . '/admin');
                    } else if ($user['user_role'] == "ROLE_ACCUEIL") {
                        header('Location: ' . PROJET_DIR . '/accueil');
                    } else if ($user['user_role'] == "ROLE_PREPARATEUR") {
                        header('Location: ' . PROJET_DIR . '/preparateur');
                    }
                    exit;
                } else {
                    // Mot de passe incorrect
                    $errorMessage = "Mot de passe incorrect.";
                }
            } else {
                // Email non trouvé
                $errorMessage = "Email inconnu.";
            }
        }
    
        // Inclure la vue avec le message d'erreur
        $base = require_once(ROOT . '/vue/admin/admin_index.php');
        $content = require_once(ROOT . '/vue/login/login_back.php');
        $base = str_replace("##CONTENT##", $content, $base);

    
        echo $base;
    }
    public function confidentialite()
    {
        $base = require_once(ROOT . '/vue/admin/admin_index.php');
        $content = file_get_contents(ROOT . '/vue/confidentialite.html');
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
}
}

