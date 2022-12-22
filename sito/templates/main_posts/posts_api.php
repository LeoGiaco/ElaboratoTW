<?php

use LDAP\Result;

require("../../bootstrap.php");

if(isset($_POST["request"])){
    switch ($_POST["request"]) {
        case 'datiTipologie':
            $rec = $dbh->getPostType();
            $result = $rec;
            break;
        case 'getPosts':
            if(isset($_POST["numeroPost"]) && isset($_POST["utente"]) && isset($_POST["checked"]) && isUserLoggedIn()){
                $nPost = $_POST["numeroPost"];
                $utente = $_POST["utente"];
                $checked = $_POST["checked"];
                if($utente=="" && $checked=="false"){
                    $posts = $dbh->getPosts($_SESSION["user"], $nPost, 5);

                    if($_POST["Like"] == 1) {
                        $result["post_reaction"] = 1;   // like
                    } else {
                        $result["post_reaction"] = -1;  // dislike
                    }
                } else if($checked=="true"){
                    $posts = $dbh->getPostsFollow($nPost, 5, $_SESSION["user"]);
                }
                else{
                    $posts = $dbh->getUserPosts($nPost, 5, $utente);
                }
                for($i=0; $i<count($posts); $i++){
                    $posts[$i]['Data']=dataoraIT($posts[$i]['Data']);
                    $posts[$i]["reactions"]=$dbh->getReactions($posts[$i]["ID"]);
                }
                $result["posts"] = $posts;
            }
            break;
        case 'aggiungiCommento':
            if(isset($_POST["nPost"]) && isset($_POST["testo"]) && isUserLoggedIn()){
                $result = $dbh->addComment($_SESSION['user'], $_POST["nPost"], $_POST["testo"]);
                $result = $rec;
            }
            break;
        case 'aggiungiReaction':
            if(isset($_POST["nPost"]) && isset($_POST["like"]) && isset($_POST["dislike"]) && isset($_POST["type"])  && isUserLoggedIn()){
                $risultato=$dbh->checkReactions($_SESSION['user'], $_POST["nPost"]);
                if(empty($risultato)){
                    $dbh->addReaction($_SESSION['user'], $_POST["nPost"], $_POST["like"], $_POST["dislike"]);

                    if($_POST["Like"] == 1) {
                        $result["post_reaction"] = 1;   // like
                    } else {
                        $result["post_reaction"] = -1;  // dislike
                    }
                }
                else {
                    if($risultato[0][$_POST["type"]]==1){
                        $dbh->deleteReaction($_SESSION['user'], $_POST["nPost"]);
                        $result["post_reaction"] = 0;
                    }
                    else{
                        $dbh->switchReaction($_SESSION['user'], $_POST["nPost"], $_POST["like"], $_POST["dislike"]);
                        
                        if($_POST["Like"] == 1) {
                            $result["post_reaction"] = 1;   // like
                        } else {
                            $result["post_reaction"] = -1;  // dislike
                        }
                    }
                }
                $result["reactions"]=$dbh->getReactions($_POST["nPost"]);
            }
            break;

        case 'commentiPost':
            if(isset($_POST["idPost"]) && isUserLoggedIn()){
                $result = $dbh->getComments($_POST['idPost']);
                for($i=0; $i<count($result); $i++){
                    $result[$i]['Data']=dataoraIT($result[$i]['Data']);
                }
            }
            break;
        case 'getUserInfo':
            if(isUserLoggedIn()){
                $result["dati"] = $dbh->getUserInfo($_SESSION['user']);
            }
            break;
        case 'nuovoPost':
            if(isset($_POST["testo"]) && isset($_POST["tipo"]) && isset($_POST["titolo"])  && isUserLoggedIn()){
                $rs_file = $rs_file = addFile($_FILES["file"], "post_img");
                if($rs_file["errore"]=="")
                    $postResult = $dbh->addPost($_SESSION["user"], $_POST["testo"], $_POST["tipo"], $_POST["titolo"], $rs_file["file"]);
                    if($postResult){
                        $result["state"]=true;
                    }
                else {
                    $result["state"]=false;
                    $result["msg"]="Errore caricamento foto, ".$rs_file["errore"];
                }
                break;
            } else {
                $result["state"]=false;
                $result["msg"]="Post non inserito, errore nei dati inseriti!";
            }
    }
}


header('Content-Type: application/json');
echo json_encode($result);


?>