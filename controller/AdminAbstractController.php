<?php

class AdminAbstractController
{


        protected $connexion;


        public function __construct()
        {
                $connexion = new ConnexionController();
                $this->connexion = $connexion->connexion;
        }
}
