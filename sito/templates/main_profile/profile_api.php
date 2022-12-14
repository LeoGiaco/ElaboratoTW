<?php

require("../../bootstrap.php");

// Controllare che request esista.
switch ($_POST["request"]) {
    case 'getUserInfo':
        if(isUserLoggedIn()){
            $result["dati"] = $dbh->getUserInfo($_SESSION['user']);
            $result["dati"][0]["DataNascita"] = dataIT($result["dati"][0]["DataNascita"]);
        }
        break;
}


header('Content-Type: application/json');
echo json_encode($result);


?>