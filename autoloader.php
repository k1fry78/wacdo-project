<?php

spl_autoload_register(function ($className) {
    if (strpos($className, "Controller") !== false) {
        require_once("controller/$className.php");
    } else { 
        require_once("model/$className.php");
    }
});
