<?php

class PreparateurController
{


    public function __construct(string $url)
    {
        $url = explode("/", $url);
        array_shift($url);
        if (empty($url[2])) {
            switch ($url[1]) {
                case "preparateur":
                $this->index();
                break;
                case "politique-confidentialite":
                    $PreparateurController = new FooterController();
                    $PreparateurController->politiqueConfidentialite();
                    break;
                case "donnees-personnelles":
                    $PreparateurController = new FooterController();
                    $PreparateurController->donneesPersonnelles();
                    break;
            }
            } else {
            switch ($url[2]) {
                case 'voir':
                    $this->voir($url[3]);
                    break;
                case 'pret':
                    $this->marquerPrete();
                    break;
                default:
                case 'deconnexion':
                    $deconnexion = new LoginDeconnexionController($url);
                    break;
                    echo "Une erreur est survenue au traitement de votre requête dans le PreparateurController.";
            }
        }
    }

    public function index()
    {
        $commande = new Commande();
        $commandes = $commande->getCommandesByStatut('Préparation');

        $base = file_get_contents(ROOT . "/vue/preparateur/preparation_index.html");
        $content = require_once(ROOT . "/vue/preparateur/preparation_liste.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function voir($commande_id)
    {

        $commandeProduit = new CommandeProduit();
        $commandeProduits = $commandeProduit->getProduitsByCommandeId($commande_id);

        $base = file_get_contents(ROOT . "/vue/preparateur/preparation_index.html");
        $content = require_once(ROOT . "/vue/preparateur/preparation_voir.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function marquerPrete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commande_id'])) {
            $commande_id = intval($_POST['commande_id']);
            $commande = new Commande();
            $commande->updateStatut($commande_id, 'Prêt');
            header('Location: http://localhost/wacdo-project/preparation');
            exit;
        } else {
            echo "Requête invalide.";
        }
    }
}
