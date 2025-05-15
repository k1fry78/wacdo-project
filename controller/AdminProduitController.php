<?php
class AdminProduitController
{

    public function __construct($url)
    {
        if (empty($url[3])) {
            $this->index();
        } else {
            switch ($url[3]) {
                case 'nouveau':
                    $this->new();
                    break;
                case 'edit':
                    $this->edit($url[4]);
                    break;
                case 'supprimer':
                    $this->delete($url[4]);
                    break;
                default:
                    echo "Une erreur est survenue au traitement de votre requête dans le AdminProduitController.";
            }
        }
    }

    private function index()
    {
        $produit = new Produit();
        $produits = $produit->getAllProduits();
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/produit/admin_liste_produit.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function new()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();
        if (isset($_POST['submit'])) {
            $nom = ucfirst(strtolower(htmlspecialchars($_POST['nom'])));
            $prix = htmlspecialchars($_POST['prix']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $description = ucfirst(strtolower(htmlspecialchars($_POST['description'])));

            $image = $_FILES['image'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageSize = $image['size'];
            $imageError = $image['error'];
            $imageType = $image['type'];

            $imageExt = explode('.', $imageName);
            $imageActualExt = strtolower(end($imageExt));

            $allowed = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($imageActualExt, $allowed)) {
                if ($imageError === 0) {
                    if ($imageSize < 5000000) {
                        $imageNameNew = uniqid('', true) . "." . $imageActualExt;
                        $imageDestination = ROOT . '/public/images/' . $imageNameNew;


                        if (!is_dir(ROOT . '/public/images')) {
                            mkdir(ROOT . '/public/images', 0777, true);
                        }

                        if (move_uploaded_file($imageTmpName, $imageDestination)) {
                            $updatedAt = date('Y-m-d H:i:s');

                            $produit = new Produit();
                            $produit->setNom($nom);
                            $produit->setPrix($prix);
                            $produit->setCategorie($categorie);
                            $produit->setDescription($description);
                            $produit->setImageFile($imageNameNew);
                            $produit->setImageSize($imageSize);
                            $produit->setUpdatedAt(new DateTimeImmutable($updatedAt));
                            $produit->save();

                            header('Location:' . PROJET_DIR . '/admin/produit');
                            return;
                        } else {
                            echo "Il y a eu une erreur lors du déplacement de votre fichier.";
                        }
                    } else {
                        echo "Votre fichier est trop volumineux.";
                    }
                } else {
                    echo "Il y a eu une erreur lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Vous ne pouvez pas télécharger des fichiers de ce type.";
            }
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/produit/admin_new_produit.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function edit($id)
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();
        $produit = new Produit();
        $produit->getDatas($id);
        if (isset($_POST["submit"])) {
            $nom = ucfirst(strtolower(htmlspecialchars($_POST['nom'])));
            $produit->setNom($nom);
            $prix = htmlspecialchars($_POST['prix']);
            $produit->setPrix($prix);
            $categorieId = htmlspecialchars($_POST['categorie']);
            if ($categorieId !== null) {
                $produit->setCategorie($categorieId);
            }
            $description = ucfirst(strtolower(htmlspecialchars($_POST['description'])));
            $produit->setDescription($description);
            $produit->update();
            header('Location: ' . PROJET_DIR . '/admin/produit');
            return;
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/produit/admin_edit_produit.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function delete($id)
    {
        $produit = new Produit();
        $produit->setId($id);
        $produit->delete($id);
        header('Location:' . PROJET_DIR . '/admin/produit');
        return;
    }
}
