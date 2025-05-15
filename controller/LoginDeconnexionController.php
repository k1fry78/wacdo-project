<?php

class LoginDeconnexionController
{

    public function __construct($url)
    {
        if (empty($url[3])) {
            $this->deconnexion();
        }
    }

    public function deconnexion()
    {
        session_destroy();
        header('Location: ' . PROJET_DIR . '');
    }
}
