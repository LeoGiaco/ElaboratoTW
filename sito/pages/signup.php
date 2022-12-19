<?php
    define("SITE_ROOT", "sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Crea_account";
    $templateParams["javascript"] = "templates/main_signup/signup.js";

    $templateParams["pieces"] = array(
        // SITE_ROOT . 'templates/header/header.php',
        'templates/main_signup/signup.php',
        'templates/footer/footer.php'
    );

    require_once 'templates/base.php';
?>