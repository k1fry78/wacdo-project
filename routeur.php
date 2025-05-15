<?php
if (session_status() == PHP_SESSION_NONE) {
    $lifetime = 1800;
    session_set_cookie_params($lifetime);
    ini_set('session.gc_maxlifetime', $lifetime);
    session_start([
        'cookie_lifetime' => 0,
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'use_strict_mode' => true,
        'use_only_cookies' => true,
        'cookie_samesite' => 'Strict',
    ]);
}

require_once("config.php");
require_once("autoloader.php");

// Analyse l'URL et détermine le contrôleur à appeler
$url = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$path = trim($parsedUrl['path'], '/');
$segments = explode('/', $path);

// Si l'URL contient "api", redirige vers le contrôleur API
if (isset($segments[1]) && $segments[1] === 'api') {
    if (!class_exists('ApiController')) {
        die('ApiController non trouvé. Vérifiez l\'autoloader.');
    }
    $apiController = new ApiController();
    $apiController->handleRequest();
    exit;
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    // Vérifie le rôle de l'utilisateur pour rediriger vers le bon contrôleur
    if ($user['user_role'] == "ROLE_ADMIN" && strpos($url, '/accueil') !== false) {
        // Si un admin tente d'accéder à une route réservée à un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_ADMIN" && strpos($url, '/preparateur') !== false) {
        // Si un utilisateur d'accueil tente d'accéder à une route réservée à un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_ADMIN") {
        $controller = new AdminController($url);
    } else if ($user['user_role'] == "ROLE_ACCUEIL" && strpos($url, '/admin') !== false) {
        // Si un utilisateur d'accueil tente d'accéder à une route réservée à un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_ACCUEIL" && strpos($url, '/preparateur') !== false) {
        // Si un utilisateur d'accueil tente d'accéder à une route réservée à un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_ACCUEIL") {
        $controller = new AccueilController($url);
    } else if ($user['user_role'] == "ROLE_PREPARATEUR" && strpos($url, '/admin') !== false) {
        // Si un préparateur tente d'accéder à une route réservée à un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_PREPARATEUR" && strpos($url, '/accueil') !== false) {
        // Si un préparateur tente d'accéder à une route réservéeà un autre rôle
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    } else if ($user['user_role'] == "ROLE_PREPARATEUR") {
        $controller = new PreparateurController($url);
    } else {
        // Affiche la vue "error-403.html" si le rôle est inconnu
        http_response_code(403);
        require_once("vue/error-403.html");
        exit;
    }
} else {
    // Redirige les utilisateurs non connectés vers la page de connexion
    $controller = new LoginController($url);
}
