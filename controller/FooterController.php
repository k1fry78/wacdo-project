<?php

class FooterController
{    
    public function politiqueConfidentialite()
    {
        $s = file_get_contents(ROOT . '/vue/confidentialite.html');
        echo $s;
    }

    public function donneesPersonnelles()
    {
        $s = file_get_contents(ROOT . '/vue/donnees-personnelles.html');
        echo $s;
    }
}
