<?php
require("../../bootstrap.php");
if($_POST["request"] == "interessiPossibili") {
    $rec = $dbh->getInterests();
    $result = $rec;
} else{
    $userResult = $dbh->checkUserAbsent($_POST["username"]);
    if(count($userResult)==0){
        $mailResult = $dbh->checkMailAbsent($_POST["email"]);
        if(count($mailResult)==0){
            // Crittografare la password prima di richiamare la funzione, in modo che inserisca nel db il risultato della crittografia e non la password in chiaro.
            $state = $dbh->addUser($_POST["username"], $_POST["nome"], $_POST["cognome"], $_POST["genere"], $_POST["nascita"], $_POST["email"], $_POST["password"]);
            $state2 = $dbh->addCredentials($_POST["username"], $_POST["email"], $_POST["password"]);
            $state3= $dbh->addInterests($_POST["username"], $_POST["interessi"]);
            if($state && $state2 && $state3){
                $result["state"]=true;
            }
            else{
                $result["state"]=false;
                $result["msg"]="Errore generico di inserimento! Possibile errore in inserimento utente, credenziali o interessi!";
            }
        }
        else{
            $result["state"]=false;
            $result["msg"]="Errore! Mail duplicata!";
        }
        
    }
    else{
        $result["state"]=false;
        $result["msg"]="Errore! Username già presente!";
    }
}

 


header('Content-Type: application/json');
echo json_encode($result);

// $articoli = $dbh->getPosts(2);

// for($i=0; $i<count($articoli); $i++){
//     $articoli[$i]["imgarticolo"] = UPLOAD_DIR.$articoli[$i]["imgarticolo"];
// }

// header("Content-Type: application/json");
// echo json_encode($articoli);
?>