<?php

class AdminController
{


    public function __construct(String $url)
    {
        $url = explode("/", $url);
        array_shift($url);
        if (empty($url[2])) {
            switch ($url[1]){
                case'admin':
                $this->index();
                break;
                case "politique-confidentialite":
                    $AccueilHomeController = new FooterController();
                    $AccueilHomeController->politiqueConfidentialite();
                    break;
                case "donnees-personnelles":
                    $AccueilHomeController = new FooterController();
                    $AccueilHomeController->donneesPersonnelles();
                    break;
            }
        } else {
            switch ($url[2]) {
                case 'utilisateur':
                    $user = new AdminUserController($url);
                    break;
                case 'categorie':
                    $categorie = new AdminCategorieController($url);
                    break;
                case 'produit':
                    $produit = new AdminProduitController($url);
                    break;
                case 'commande':
                    $commande = new AdminCommandeController($url);
                    break;
                case 'deconnexion':
                    $preparation = new LoginDeconnexionController($url);
                    break;
                default:
                    echo "Action non reconnue.";
                    break;
            }
        }
    }


    public function index()
    {
        new Commande ();
        $commande = new Commande();
        $totalJournee = $commande->totalJournee();
        $nombreCommandes = $commande->nombreCommandesJournee();
        
        $base = require_once(ROOT . '/vue/admin/admin_index.php');
        $content = require_once(ROOT . '/vue/admin/admin_home.php');
        $base = str_replace("##CONTENT##", $content, $base);
        $base = str_replace("##TOTAL_JOURNEE##", number_format($totalJournee, 2, ',', ' '), $base);
        $base = str_replace("##NOMBRE_COMMANDES##", $nombreCommandes, $base);


        echo $base;
    }
}
