<?php

class User extends AbstractModel
{

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $role;

    public function __construct()
    {
        parent::__construct();
    }


    public function getAllUsers()
    {
        $sql = "SELECT * FROM utilisateur";
        $query = $this->connexion->query($sql);
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($users as $user) {
            $u = new User();
            $u->setId($user['user_id']);
            $u->setNom($user['user_nom']);
            $u->setPrenom($user['user_prenom']);
            $u->setEmail($user['user_email']);
            $u->setPassword($user['user_password']);
            $u->setRole($user['user_role']);
            $collection[] = $u;
        }
        return $collection;
    }
    public function getDatas($id)
    {

        $sql = "SELECT * FROM utilisateur WHERE user_id = :id";
        $sql = $this->connexion->prepare($sql);
        $sql->execute(array(':id' => $id));
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        $this->id = $user['user_id'];
        $this->nom = $user['user_nom'];
        $this->prenom = $user['user_prenom'];
        $this->email = $user['user_email'];
        $this->role = $user['user_role'];
        return $this;
    }

    public function update()
    {

        $sql = "UPDATE utilisateur SET user_nom = :nom, user_prenom = :prenom, user_email = :email, user_role = :roles WHERE user_id = :id";
        $req = $this->connexion->prepare($sql);
        $req->execute(array(
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'roles' => $this->role,
            'id' => $this->id
        ));
        $_SESSION['message'] = "Le livre a bien été modifié";
    }

    public function save()
    {

        $sql = "INSERT INTO utilisateur (user_nom, user_prenom, user_email, user_password, user_role) VALUES (:nom, :prenom, :email, :password, :role)";
        $query = $this->connexion->prepare($sql);
        $query->execute(array(
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ));
        $_SESSION['message'] = "L'utilisateur a bien été ajouté";
    }

    public function delete($id)
    {

        $sql = "DELETE FROM utilisateur WHERE user_id = :id";
        $req = $this->connexion->prepare($sql);
        $req->execute(array("id" => $id));
        $_SESSION['message'] = "L'utilisateur a bien été supprimé";
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
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
