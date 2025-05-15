<?php

class AdminCommandeController
{

    public function __construct($url)
    {
        if (empty($url[3])) {
            $this->index();
        } else {
            switch ($url[3]) {
                case 'suppression':
                    $this->suppression();
                    break;
                case 'delete':
                    $this->delete($url[4]);
                    break;
                default:
                    echo "Une erreur est survenue au traitement de votre requête dans le AdminProduitController.";
            }
        }
    }

    public function index()
    {
        $commande = new Commande();
        $commandes = $commande->getAllCommandes();
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/commande/admin_liste_commande.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }
    private function delete($id)
    {
        echo 'function delete appelée';
        $commande = new Commande();
        $commande->delete($id);
        header('Location:' . PROJET_DIR . '/admin/commande');
        return;
    }
    public function suppression()
    {
        $commande = new Commande();
        $commande->supprimerCommmandesVides();
        header('Location: ' . PROJET_DIR . '/admin/commande');
    }
}
