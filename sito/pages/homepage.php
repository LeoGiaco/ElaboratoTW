<?php
    define("SITE_ROOT", "/sito/"); // FIXME: VERIFICA UTILITA'

    require_once(SITE_ROOT.'bootstrap.php');

    $templateParams["title"] = "Uv-Home";
    $templateParams["javascript"] = "templates/main_posts/posts.js";
    $templateParams["jsHeader"] = "templates/header/header.js";
    if(!isUserLoggedIn()){
        header("location: login.php");
    }

    $templateParams["pieces"] = array(
        'templates/header/header.php',
        'templates/main_posts/posts.php',
        // SITE_ROOT . 'templates/aside_right_posts/posts_n_friends.php',
        'templates/footer/footer.php'
    );

    require_once 'templates/base.php';
?>