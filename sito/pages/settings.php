<?php
    define("SITE_ROOT", "/sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Profile";
    $templateParams["javascript"] = "templates/main_settings/settings.js";
    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["pieces"] = array(
        'templates/header/header.php',
        'templates/main_settings/settings.php',
        'templates/footer/footer.php'
    );

    require_once 'templates/base.php';
?>