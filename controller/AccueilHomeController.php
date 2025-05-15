<?php

class AccueilHomeController
{



    public function menu()
    {

        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('15');
        $complements = $produit->getProduitsByCategorie('7');
        $boissons = $produit->getProduitsByCategorie('6');

        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();
        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_menu.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function commander()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'commander') {
            $commande = new Commande();
            $commande->setDate(date('Y-m-d H:i:s'));
            $commande->setStatut('En cours');
            $commande->save();
            $_SESSION['commande_id'] = $commande->getId();
        }
        $commande = new Commande();
        $collection = $commande->getAllCommandes();

        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();
        $content =  require_once(ROOT . "/vue/accueil/accueil_home.php");
        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function delivrer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commande_id'])) {
            $commande = new Commande();
            $commande->updateStatut($_POST['commande_id'], 'Délivré');
        }
        header('Location: /wacdo-project/accueil');
        exit;
    }

    public function annuler()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commande_id'])) {
            $commande = new Commande();
            $commande->delete($_POST['commande_id']);
        }
        header('Location: /wacdo-project/accueil');
        exit;
    }

    public function ajouterPanier()
    {
        if (!isset($_SESSION['commande_id'])) {
            // Si aucune commande n'existe, affichez un message d'erreur
            $_SESSION['message'] = "Aller dans l'accueil pour crée une commande !";
            $referer = $_SERVER['HTTP_REFERER']; // Redirigez vers la page précédente
            header('Location: ' . $referer);
            exit;
        }

        // Si une commande existe, ajoutez le produit au panier
        $commande_produit = new CommandeProduit();
        $commande_produit->setCommande_id($_SESSION['commande_id']);
        $commande_produit->setProduit_id($_POST['produit_id']);
        $commande_produit->setQuantite($_POST['quantite']);
        $commande_produit->setDetails($_POST['complement_id'] . ' ' . $_POST['boisson_id']);
        $commande_produit->save();
        $_SESSION['commande_produit_id'] = $commande_produit->getId();

        // Message de succès
        $_SESSION['message'] = "Produit ajouté !";

        $referer = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $referer);
        exit;
    }

    public function panier()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['commande_id'])) {
            echo "Aucune commande en cours.";
            exit;
        }


        $commande_id = $_SESSION['commande_id'];

        $commande = new Commande();
        $commande->updatePrixTotal($commande_id);


        $commandeProduit = new CommandeProduit();
        $commandeProduits = $commandeProduit->getProduitsByCommandeId($commande_id);

        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();

        $content = require_once(ROOT . "/vue/accueil/accueil_panier.php");
        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function payer()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['commande_id'])) {
            echo "Aucune commande en cours.";
            exit;
        }
        $commande_id = $_SESSION['commande_id'];

        $commande = new Commande();
        $commande->updateStatut($commande_id, 'Préparation');

        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();

        $content = require_once(ROOT . "/vue/accueil/accueil_payer.php");
        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function supprimer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $commandeProduit = new CommandeProduit();
            $commandeProduit->delete($id);
        }
        $_SESSION['message'] = "Produit supprimé !";

        header('Location: ' . PROJET_DIR . '/accueil/panier');
        exit;
    }

    public function burger()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('1');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_burger.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function petiteFaim()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('2');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_petite_faim.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    public function glace()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('4');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_glace.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }


    public function milkshake()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('5');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_milkshake.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }


    public function boisson()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('6');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_boisson.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }


    public function complément()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();



        $produit = new Produit();
        $produits = $produit->getProduitsByCategorie('7');

        $base = require_once(ROOT . "/vue/accueil/accueil_index.php");
        $content = require_once(ROOT . "/vue/accueil/accueil_complément.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }
}
