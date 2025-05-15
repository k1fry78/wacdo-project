<?php
class AdminCategorieController
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
                case 'delete':
                    $this->delete($url[4]);
                    break;
            }
        }
    }


    private function index()
    {
        $categorie = new Categorie();
        $categories = $categorie->getAllCategories();
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/categorie/admin_liste_categorie.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function new()
    {
        if (isset($_POST['submit'])) {
            $nom = ucfirst(strtolower(htmlspecialchars($_POST['nom'])));
            $categorie = new Categorie();
            $categorie->setNom($nom);
            $categorie->save();

            header('Location:' . PROJET_DIR . '/admin/categorie');
            return;
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = file_get_contents(ROOT . "/vue/admin/categorie/admin_new_categorie.html");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function edit($id)
    {
        $categorie = new Categorie();
        $categorie->getDatas($id);
        if (isset($_POST["submit"])) {
            $nom = ucfirst(strtolower(htmlspecialchars($_POST['nom'])));
            $categorie->setNom($nom);
            $categorie->update();
            header('Location: ' . PROJET_DIR . '/admin/categorie');
            return;
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/categorie/admin_edit_categorie.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function delete($id)
    {
        $categorie = new Categorie();
        $categorie->setId($id);
        $categorie->delete($id);
        header('Location:' . PROJET_DIR . '/admin/categorie');
        return;
    }
}
