<?php

require("../../bootstrap.php");

// Controllare che request esista.
switch ($_POST["request"]) {
    case 'getUserInfo':
        if(isset($_POST["user"]) && isUserLoggedIn()){
            $result["dati"] = $dbh->getUserInfo($_POST['user']);
            $result["dati"][0]["DataNascita"] = dataIT($result["dati"][0]["DataNascita"]);
            if($result["dati"][0]["Sesso"]=="M"){
                $result["dati"][0]["Sesso"] = "Maschio";
            } else if ($result["dati"][0]["Sesso"]=="F"){
                $result["dati"][0]["Sesso"] = "Femmina";
            }
        }
        break;

    case 'getFriendship':
        if(isset($_POST["user"]) && isUserLoggedIn()){
            $result["dati"]["seguaci"] = $dbh->getFollower($_POST['user']);
            $result["dati"]["seguiti"] = $dbh->getFollow($_POST['user']);
        }
        break;
}


header('Content-Type: application/json');
echo json_encode($result);


?>