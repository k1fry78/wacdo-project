<?php

class Categorie extends AbstractModel
{


    private $id;
    private $nom;
    private $image;


    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categorie";
        $query = $this->connexion->query($sql);
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($categories as $categorie) {
            $c = new Categorie();
            $c->setId($categorie['categorie_id']);
            $c->setNom($categorie['categorie_nom']);
            $c->setImage($categorie['categorie_image']);
            $collection[] = $c;
        }
        return $collection;
    }

    public function getDatas($id)
    {

        $sql = "SELECT * FROM categorie WHERE categorie_id = :id";
        $sql = $this->connexion->prepare($sql);
        $sql->execute(array(':id' => $id));
        $categorie = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id = $categorie['categorie_id'];
        $this->nom = $categorie['categorie_nom'];
        $this->image = $categorie['categorie_image'];
        return $this;
    }


    public function update()
    {
        $sql = "UPDATE categorie SET categorie_nom = :nom, categorie_image = :image WHERE categorie_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':nom' => $this->nom,
            ':image' => $this->image,
            ':id' => $this->id
        ));
        $_SESSION['message'] = "La catégorie a bien été modifié";
    }

    public function save()
    {
        $sql = "INSERT INTO categorie (categorie_nom) VALUES (:nom)";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':nom' => $this->nom,
        ));
        $_SESSION['message'] = "La catégorie a bien été ajouté";
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categorie WHERE categorie_id = :id";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':id' => $id
        ));
        $_SESSION['message'] = "La catégorie a bien été supprimé";
    }


    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */


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
}
