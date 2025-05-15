<?php

class Produit extends AbstractModel
{

    private $id;
    private $nom;
    private $prix;
    private $categorie;
    private $description;
    private $imageFile;
    private $imageSize;
    private $updatedAt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProduits()
    {
        $sql = "SELECT * FROM produit";
        $query = $this->connexion->query($sql);
        $produits = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($produits as $produit) {
            $p = new Produit();
            $p->setId($produit['produit_id']);
            $p->setNom($produit['produit_nom']);
            $p->setPrix($produit['produit_prix']);
            $p->setCategorie($produit['produit_categorie_id']);
            $p->setDescription($produit['produit_description']);
            $p->setImageFile($produit['produit_image_name']);
            $p->setImageSize($produit['produit_image_size']);
            $updatedAt = $produit['produit_updated_at'] ?? '1970-01-01 00:00:00';
            $p->setUpdatedAt(new DateTimeImmutable($updatedAt));
            $collection[] = $p;
        }
        return $collection;
    }
    public function getAllProduitsApi()
    {
        $sql = "SELECT * FROM produit";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDatas($id)
    {
        $sql = "SELECT * FROM produit WHERE produit_id = :id";
        $sql = $this->connexion->prepare($sql);
        $sql->execute(array(':id' => $id));
        $produit = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id = $produit['produit_id'];
        $this->nom = $produit['produit_nom'];
        $this->categorie = $produit['produit_categorie_id'];
        $this->description = $produit['produit_description'];
        $this->prix = $produit['produit_prix'];
        $this->imageFile = $produit['produit_image_name'];
        $this->imageSize = $produit['produit_image_size'];
        return $this;
    }

    public function getProduitsByCategorie($id)
    {
        $sql = "
         produit_categorie_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(':id' => $id));
        $produits = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($produits as $produit) {
            $p = new Produit();
            $p->setId($produit['produit_id']);
            $p->setNom($produit['produit_nom']);
            $p->setPrix($produit['produit_prix']);
            $p->setCategorie($produit['produit_categorie_id']);
            $p->setDescription($produit['produit_description']);
            $p->setImageFile($produit['produit_image_name']);
            $p->setImageSize($produit['produit_image_size']);
            $collection[] = $p;
        }
        return $collection;
    }
    public function getProduitsByCategorieApi($categorie_id)
    {
        $sql = "SELECT * FROM produit WHERE produit_categorie_id = :categorie_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrixById($produit_id)
    {
        $sql = "SELECT prix FROM produit WHERE id = :produit_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':produit_id', $produit_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['prix'];
    }
    public function getNomById($produit_id)
    {
        $sql = "SELECT nom FROM produit WHERE id = :produit_id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':produit_id', $produit_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['nom'];
    }

    public function update()
    {
        $sql = "UPDATE produit SET produit_nom = :nom, produit_prix = :prix, produit_description = :description, produit_categorie_id = :categorie, produit_image_name = :image_nom, produit_image_size = :image_size WHERE produit_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':nom' => $this->nom,
            ':prix' => $this->prix,
            ':description' => $this->description,
            ':categorie' => $this->categorie,
            ':id' => $this->id,
            ':image_nom' => $this->imageFile,
            ':image_size' => $this->imageSize,
        ));
        $_SESSION['message'] = "Le produit a bien été modifiée";
    }

    public function save()
    {
        $sql = "INSERT INTO produit (produit_nom, produit_prix, produit_categorie_id, produit_description, produit_image_name, produit_image_size, produit_updated_at) VALUES (:nom, :prix, :categorie, :description, :image_nom, :image_size, :image_updated)";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':nom' => $this->nom,
            ':prix' => $this->prix,
            ':categorie' => $this->categorie,
            ':description' => $this->description,
            ':image_nom' => $this->imageFile,
            ':image_size' => $this->imageSize,
            ':image_updated' => $this->updatedAt->format('Y-m-d H:i:s')
        ));
        $_SESSION['message'] = "Le produit a bien été ajoutée";
    }

    public function delete($id)
    {
        $sql = "DELETE FROM produit WHERE produit_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(':id' => $id));
        $_SESSION['message'] = "Le produit a bien été supprimé";
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setImageFile(?string $imageFile = null): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): static
    {
        $this->imageSize = $imageSize;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
