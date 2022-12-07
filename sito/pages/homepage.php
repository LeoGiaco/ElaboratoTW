<?php
    define("SITE_ROOT", "/var/www/html/ElaboratoTW/sito/");

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Home";
    $templateParams["javascript"] = "../templates/main_posts/posts.js";
    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["pieces"] = array(
        SITE_ROOT . 'templates/header/header.php',
        SITE_ROOT . 'templates/main_posts/posts.php',
        // SITE_ROOT . 'templates/aside_right_posts/posts_n_friends.php',
        SITE_ROOT . 'templates/footer/footer.php'
    );

    require_once SITE_ROOT . 'templates/base.php';
?>