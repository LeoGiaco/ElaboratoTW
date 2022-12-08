<?php
    define("SITE_ROOT", "/var/www/html/ElaboratoTW/sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Login";
    $templateParams["javascript"] = "../templates/main_login/login.js";

    $templateParams["pieces"] = array(
        SITE_ROOT . 'templates/main_login/login.php',
        SITE_ROOT . 'templates/footer/footer.php'
    );

    require_once SITE_ROOT . 'templates/base.php';
?>