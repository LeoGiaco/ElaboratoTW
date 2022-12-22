<?php
require("../../bootstrap.php");

if(isset($_POST["request"])){
    if($_POST["request"] == "exit"){
        unset($_SESSION["user"]);
        $result="ok";
    }
}

header('Content-Type: application/json');
echo json_encode($result);
?>