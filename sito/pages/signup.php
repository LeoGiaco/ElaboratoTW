<?php
    define("SITE_ROOT", "/var/www/html/ElaboratoTW/sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv - Crea account";

    $templateParams["pieces"] = array(
        // SITE_ROOT . 'templates/header/header.php',
        SITE_ROOT . 'templates/main_signup/signup.php',
        SITE_ROOT . 'templates/footer/footer.php'
    );

    require_once SITE_ROOT . 'templates/base.php';
?>