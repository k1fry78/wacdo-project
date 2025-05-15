<?php
class ApiController
{
    public function __construct()
    {
        // Ajouter des en-têtes CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    public function handleRequest()
    {
        // Définir le type de contenu comme JSON
        header('Content-Type: application/json');

        // Vérifier la méthode HTTP et l'action demandée
        $action = isset($_GET['action']) ? $_GET['action'] : null;

        switch ($action) {
            case 'getProduitsByCategorie':
                $this->getProduitsByCategorieApi();
                break;
            case 'getCommandes':
                $this->getCommandes();
                break;
            case 'getProduits':
                $this->getProduits();
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Action non supportée']);
        }
    }
    private function getProduits()
    {
        $commande = new Produit();
        $commandes = $commande->getAllProduitsApi();

        if (empty($commandes)) {
            echo json_encode(['status' => 'error', 'message' => 'Aucune commande trouvée']);
            return;
        }

        echo json_encode(['status' => 'success', 'data' => $commandes]);
    }
    private function getProduitsByCategorieApi()
    {
        if (!isset($_GET['categorie_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'ID de catégorie manquant']);
            return;
        }

        $categorie_id = intval($_GET['categorie_id']);
        if ($categorie_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID de catégorie invalide']);
            return;
        }

        $produit = new Produit();
        $produits = $produit->getProduitsByCategorieApi($categorie_id);

        if (empty($produits)) {
            echo json_encode(['status' => 'error', 'message' => 'Aucun produit trouvé pour cette catégorie']);
            return;
        }

        echo json_encode(['status' => 'success', 'data' => $produits]);
    }

    private function getCommandes()
    {
        $commande = new Commande();
        $commandes = $commande->getAllCommandesApi();

        if (empty($commandes)) {
            echo json_encode(['status' => 'error', 'message' => 'Aucune commande trouvée']);
            return;
        }

        echo json_encode(['status' => 'success', 'data' => $commandes]);
    }
}
