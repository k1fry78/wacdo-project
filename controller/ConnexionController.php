
<?php

class ConnexionController
{

    public $connexion;
    const HOST = "localhost";
    const DBNAME = "wacdo_project";
    const USER = "root";
    const PASSWORD = "";

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=utf8", self::USER, self::PASSWORD);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
