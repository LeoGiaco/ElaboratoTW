<?php
require("../../bootstrap.php");
 // Crittografare la password prima di richiamare la funzione, in modo che inserisca nel db il risultato della crittografia e non la password in chiaro.
$dbh->addUser($_POST["username"], $_POST["nome"], $_POST["cognome"], $_POST["genere"], $_POST["nascita"], $_POST["email"], $_POST["password"]);
// $articoli = $dbh->getPosts(2);

// for($i=0; $i<count($articoli); $i++){
//     $articoli[$i]["imgarticolo"] = UPLOAD_DIR.$articoli[$i]["imgarticolo"];
// }

// header("Content-Type: application/json");
// echo json_encode($articoli);


?>