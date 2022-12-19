<?php
require("sito/bootstrap.php");

if(isset($_POST["request"])){
    if($_POST["request"] == "cercaUtente"){
        
    }
}

header('Content-Type: application/json');
echo json_encode($result);
?>