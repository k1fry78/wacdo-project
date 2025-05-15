<?php

class AccueilController
{

    public function __construct(string $url)
    {
        $url = explode("/", $url);
        array_shift($url);

        if (empty($url[2])) {
            switch ($url[1]) {
                case "accueil":
                    $AccueilHomeController = new AccueilHomeController();
                    $AccueilHomeController->commander();
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
            if (empty($url[3])) {
                switch ($url[2]) {
                    case "menu":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->menu();
                    case "burger":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->burger();
                        break;
                    case "petite_faim":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->petiteFaim();
                        break;
                    case "glace":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->glace();
                        break;
                    case "milkshake":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->milkshake();
                        break;
                    case "boisson":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->boisson();
                        break;
                    case "complement":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->complément();
                        break;
                    case "deconnexion":
                        $AccueilHomeController = new LoginDeconnexionController($url);
                        $AccueilHomeController->deconnexion();
                        break;
                    case "panier":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->panier();
                        break;
                    case "ajouterpanier":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->ajouterPanier();
                        break;
                    case "delivrer":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->delivrer();
                        break;
                    case "annuler":
                        $AccueilHomeController = new AccueilHomeController();
                        $AccueilHomeController->annuler();
                        break;
                }
            } else {
                if (empty($url[5])) {
                    switch ($url[3]) {
                        case "payer":
                            $AccueilHomeController = new AccueilHomeController();
                            $AccueilHomeController->payer();
                            break;
                        case "supprimer":
                            $AccueilHomeController = new AccueilHomeController();
                            $AccueilHomeController->supprimer($url[4]);
                            break;
                    }
                }
            }
        }
    }
}
