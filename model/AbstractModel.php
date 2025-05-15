<?php

class AbstractModel
{

    protected $connexion;

    public function __construct()
    {
        require_once(ROOT . "/Controller/ConnexionController.php");
        $connexion = new ConnexionController();
        $this->connexion = $connexion->connexion;
    }
}
