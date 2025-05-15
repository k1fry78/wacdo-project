<?php
class AdminUserController
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
        $user = new User();
        $users = $user->getAllUsers();
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/utilisateur/admin_liste_user.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function new()
    {
        if (isset($_POST['submit'])) {
            $nom = mb_convert_case(htmlspecialchars($_POST['nom']), MB_CASE_TITLE, "UTF-8");
            $prenom = mb_convert_case(htmlspecialchars($_POST['prenom']), MB_CASE_TITLE, "UTF-8");
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $role = $_POST['role'];
            $user = new User();
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRole($role);
            $user->save();
            header('Location:' . PROJET_DIR . '/admin/utilisateur');
            return;
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = file_get_contents(ROOT . "/vue/admin/utilisateur/admin_new_user.html");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function edit($id)
    {
        $user = new User();
        $user->getDatas($id);
        if (isset($_POST["submit"])) {
            $nom = ucfirst(strtolower(htmlspecialchars($_POST['nom'])));
            $user->setNom($nom);
            $prenom = ucfirst(strtolower(htmlspecialchars($_POST['prenom'])));
            $user->setPrenom($prenom);
            $email = htmlspecialchars($_POST['email']);
            $user->setEmail($email);
            $role = $_POST['role'];
            $user->setRole($role);
            $user->update();
            header('Location: ' . PROJET_DIR . '/admin/utilisateur');
            return;
        }
        $base = require_once(ROOT . "/vue/admin/admin_index.php");
        $content = require_once(ROOT . "/vue/admin/utilisateur/admin_edit_user.php");
        $base = str_replace("##CONTENT##", $content, $base);
        echo $base;
    }

    private function delete($id)
    {
        $user = new User();
        $user->delete($id);
        header('Location:' . PROJET_DIR . '/admin/utilisateur');
        return;
    }
}
