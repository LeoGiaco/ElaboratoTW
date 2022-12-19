<?php
require("../../bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    $mailResult = $dbh->checkMailAbsent($_POST["email"]);
    if(count($mailResult)!=0){
        // Passare risultato di funzione crittografica applicata alla password.
        $loginResult = $dbh->login($_POST["email"], $_POST["password"]);
        if(count($loginResult)==1){
            $result["state"]=true;
            registerLoggedUser($dbh->getUsernameFromMail($_POST["email"])[0]["Utente"]);
        }
        else{
            $result["state"]=false;
            $result["msg"]="Password errata!";
        }
    }
    else{
        $result["state"]=false;
        $result["msg"]="Errore! Mail inserita non presente!";
    }
}
header('Content-Type: application/json');
echo json_encode($result);
?>