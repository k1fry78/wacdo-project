<?php

class Commande extends AbstractModel
{

   private $id;
   private $prix;
   private $date;
   private $statut;

   public function __construct()
   {
      parent::__construct();
   }

   public function getAllCommandes()
   {
      $sql = "SELECT * FROM commande";
      $query = $this->connexion->query($sql);
      $commandes = $query->fetchAll(PDO::FETCH_ASSOC);
      $collection = [];
      foreach ($commandes as $commande) {
         $c = new Commande();
         $c->setId($commande['commande_id']);
         $c->setPrix($commande['commande_prix']);
         $c->setDate($commande['commande_date']);
         $c->setStatut($commande['commande_statut']);
         $collection[] = $c;
      }
      return $collection;
   }
   public function getAllCommandesApi()
   {
      $sql = "SELECT * FROM commande";
      $stmt = $this->connexion->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getCommandesByStatut($statut)
   {
      $sql = "SELECT * FROM commande WHERE commande_statut = :statut ORDER BY commande_date ASC";
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
      $stmt->execute();
      $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $collection = [];
      foreach ($commandes as $commande) {
         $c = new Commande();
         $c->setId($commande['commande_id']);
         $c->setPrix($commande['commande_prix']);
         $c->setDate($commande['commande_date']);
         $c->setStatut($commande['commande_statut']);
         $collection[] = $c;
      }

      return $collection;
   }


   public function getCommandeById($id)
   {
      $sql = "SELECT * FROM commande WHERE commande_id = :id";
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $commande = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($commande) {
         $this->setId($commande['commande_id']);
         $this->setPrix($commande['commande_prix']);
         $this->setDate($commande['commande_date']);
         $this->setStatut($commande['commande_statut']);
         return $this;
      } else {
         return null;
      }
   }

   public function updatePrixTotal($commande_id)
   {
      $commandeProduit = new CommandeProduit();
      $prixTotal = $commandeProduit->calculerTotalProduits($commande_id);

      $sql = "UPDATE commande SET commande_prix = :prix WHERE commande_id = :commande_id";
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindParam(':prix', $prixTotal, PDO::PARAM_STR);
      $stmt->bindParam(':commande_id', $commande_id, PDO::PARAM_INT);
      $stmt->execute();
   }

   public function updateStatut($commande_id, $statut)
   {
      $sql = "UPDATE commande SET commande_statut = :statut WHERE commande_id = :id";
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
      $stmt->bindParam(':id', $commande_id, PDO::PARAM_INT);
      $stmt->execute();
   }


   public function save()
   {
      $sql = "INSERT INTO commande (commande_date, commande_prix, commande_statut) VALUES (:date, :prix, :statut)";
      $query = $this->connexion->prepare($sql);
      $query->execute(array(
         ':date' => $this->date,
         ':prix' => $this->prix,
         ':statut' => $this->statut
      ));
      $this->id = $this->connexion->lastInsertId();
   }

   public function delete($id)
   {
      $sql = "DELETE FROM commande WHERE commande_id = :id";
      $query = $this->connexion->prepare($sql);
      $query->bindParam(':id', $id, PDO::PARAM_INT);
      $query->execute();
   }

   public function supprimerCommmandesVides()
   {
      $delai = 600;

      $sql = "SELECT c.commande_id FROM commande c
              LEFT JOIN commande_produit cp ON c.commande_id = cp.commande_id
              WHERE cp.commande_id IS NULL AND c.commande_date < NOW() - INTERVAL :delai SECOND";
      $stmt = $this->connexion->prepare($sql);
      $stmt->bindParam(':delai', $delai, PDO::PARAM_INT);
      $stmt->execute();
      $commandesVides = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($commandesVides as $commande) {
         $sql = "DELETE FROM commande WHERE commande_id = :commande_id";
         $stmt = $this->connexion->prepare($sql);
         $stmt->bindParam(':commande_id', $commande['commande_id'], PDO::PARAM_INT);
         $stmt->execute();
      }
   }
   public function totalJournee()
   {
      $today = date('Y-m-d');
      $sql = "SELECT SUM(commande_prix) AS total_journee FROM commande WHERE DATE(commande_date) = :today AND commande_statut = :statut";
      $stmt = $this->connexion->prepare($sql);
      $statut = 'délivré'; // Filtre sur le statut "délivré"
      $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
      $stmt->bindParam(':today', $today, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['total_journee'] ?? 0;
   }
   public function nombreCommandesJournee()
   {
      $today = date('Y-m-d'); // Récupère la date du jour
      $sql = "SELECT COUNT(*) AS nombre_commandes 
               FROM commande 
               WHERE DATE(commande_date) = :today AND commande_statut = :statut";
      $stmt = $this->connexion->prepare($sql);
      $statut = 'délivré'; // Filtre sur le statut "délivré"
      $stmt->bindParam(':today', $today, PDO::PARAM_STR);
      $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['nombre_commandes'] ?? 0;
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
    * Get the value of date
    */
   public function getDate()
   {
      return $this->date;
   }

   /**
    * Set the value of date
    *
    * @return  self
    */
   public function setDate($date)
   {
      $this->date = $date;

      return $this;
   }

   /**
    * Get the value of etat
    */
   public function getStatut()
   {
      return $this->statut;
   }

   /**
    * Set the value of etat
    *
    * @return  self
    */
   public function setStatut($statut)
   {
      $this->statut = $statut;

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
}
