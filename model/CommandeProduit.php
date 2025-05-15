<?php

class CommandeProduit extends AbstractModel
{

    private $id;
    private $commande_id;
    private $produit_id;
    private $prix;
    private $quantite;
    private $details;

    public function __construct()
    {
        parent::__construct();
    }

    public function calculerTotalProduits($commande_id)
    {
        $sql = "SELECT SUM(cp.quantite * p.produit_prix) AS total
            FROM commande_produit cp
            INNER JOIN produit p ON cp.produit_id = p.produit_id
            WHERE cp.commande_id = :commande_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':commande_id', $commande_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'] ?? 0;
    }

    public function getAllCommandeProduit()
    {
        $sql = "SELECT * FROM commande_produit";
        $query = $this->connexion->query($sql);
        $commandes_produit = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($commandes_produit as $commande_produit) {
            $c = new CommandeProduit();
            $c->setId($commande_produit['commande_produit_id']);
            $c->setCommande_id($commande_produit['commande_id']);
            $c->setProduit_id($commande_produit['produit_id']);
            $c->setQuantite($commande_produit['quantite']);
            $c->setPrix($commande_produit['prix']);
            $c->setDetails($commande_produit['details']);
            $collection[] = $c;
        }
        return $collection;
    }
    public function getProduitsByCommandeId($commande_id)
    {
        $sql = "SELECT * FROM commande_produit WHERE commande_id = :commande_id";
        $query = $this->connexion->prepare($sql);
        $query->execute([':commande_id' => $commande_id]);
        $commandes_produit = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($commandes_produit as $commande_produit) {
            $c = new CommandeProduit();
            $c->setId($commande_produit['commande_produit_id']);
            $c->setCommande_id($commande_produit['commande_id']);
            $c->setProduit_id($commande_produit['produit_id']);
            $c->setQuantite($commande_produit['quantite']);
            $c->setDetails($commande_produit['details']);
            $collection[] = $c;
        }
        return $collection;
    }
    public function getCommandeProduitById($id)
    {
        $sql = "SELECT * FROM commande_produit WHERE commande_produit_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute([':id' => $id]);
        $commande_produit = $query->fetch(PDO::FETCH_ASSOC);
        $this->setId($commande_produit['commande_produit_id']);
        $this->setCommande_id($commande_produit['commande_id']);
        $this->setProduit_id($commande_produit['produit_id']);
        $this->setQuantite($commande_produit['quantite']);
        $this->setDetails($commande_produit['details']);
    }

    public function save()
    {
        $sql = "INSERT INTO commande_produit (commande_id, produit_id, quantite, details) VALUES (:commande_id, :produit_id, :quantite, :details)";
        $query = $this->connexion->prepare($sql);
        $query->execute([
            'commande_id' => $this->commande_id,
            'produit_id' => $this->produit_id,
            'quantite' => $this->quantite,
            'details' => $this->details
        ]);
        $this->id = $this->connexion->lastInsertId();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM commande_produit WHERE commande_produit_id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update()
    {
        $sql = "UPDATE commande_produit SET commande_id = :commande_id, produit_id = :produit_id, quantite = :quantite, details = :details, WHERE commande_produit_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute([
            'commande_id' => $this->commande_id,
            'produit_id' => $this->produit_id,
            'quantite' => $this->quantite,
            'details' => $this->details,
            'id' => $this->id
        ]);
    }




    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of commande_id
     */
    public function getCommande_id()
    {
        return $this->commande_id;
    }

    /**
     * Set the value of commande_id
     *
     * @return  self
     */
    public function setCommande_id($commande_id)
    {
        $this->commande_id = $commande_id;

        return $this;
    }

    /**
     * Get the value of produit_id
     */
    public function getProduit_id()
    {
        return $this->produit_id;
    }

    /**
     * Set the value of produit_id
     *
     * @return  self
     */
    public function setProduit_id($produit_id)
    {
        $this->produit_id = $produit_id;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of détails
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set the value of détails
     *
     * @return  self
     */
    public function setDetails($détails)
    {
        $this->details = $détails;

        return $this;
    }
}
