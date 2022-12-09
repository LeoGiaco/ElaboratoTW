<?php
require("../../bootstrap.php");
if($_POST["request"] == "interessiPossibili") {
    $rec = $dbh->getInterests();
    $result["dati"] = $rec;
} else if($_POST["request"] == "aggiungiUtente"){
    $userResult = $dbh->checkUserAbsent($_POST["username"]);
    if(count($userResult)==0){
        $mailResult = $dbh->checkMailAbsent($_POST["email"]);
        if(count($mailResult)==0){
            $state = $dbh->addUser($_POST["username"], $_POST["nome"], $_POST["cognome"], $_POST["genere"], $_POST["nascita"], $_POST["email"], $_POST["password"]);
            $state2 = $dbh->addCredentials($_POST["username"], $_POST["email"], $_POST["password"]);            
            $val = $dbh->getInterests();
            foreach ($val as $value) {
                if(!empty($_POST[$value["Nome"]])){
                    $state3= $dbh->addInterests($_POST["username"], $_POST[$value["Nome"]]);
                }
            }
            if($state && $state2 && $state3){
                $result["state"]=true;
            }
            else{
                $result["state"]=false;
                $result["msg"]="Errore di inserimento del nuovo utente!";
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