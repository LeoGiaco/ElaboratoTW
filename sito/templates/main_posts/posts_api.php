<?php
require("../../bootstrap.php");

if($_POST["request"] == "datiTipologie") {
    $rec = $dbh->getPostType();
    $result = $rec;
} else {

}

// $loginResult = $dbh->login($_POST["email"], $_POST["password"]);
// if(count($loginResult)==1){
//     $result["state"]=true;
//     registerLoggedUser($_POST["email"]);
// }
// else{
//     $result["state"]=false;
//     $result["msg"]="Password errata!";
// }

// $result["state"]=false;
// $result["msg"]="Errore! Mail inserita non presente!";

header('Content-Type: application/json');
echo json_encode($result);
?>