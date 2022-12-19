<?php
    define("SITE_ROOT", "sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Profile";
    $templateParams["javascript"] = "templates/main_profile/profile.js";
    $templateParams["jsHeader"] = "templates/main_posts/posts.js";
    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["pieces"] = array(
        'templates/header/header.php',
        'templates/main_profile/profile.php',
        'templates/footer/footer.php'
    );

    require_once 'templates/base.php';
?>