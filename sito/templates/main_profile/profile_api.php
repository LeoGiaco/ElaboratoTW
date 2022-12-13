<?php

require("../../bootstrap.php");

// Controllare che request esista.
switch ($_POST["request"]) {
   
}


header('Content-Type: application/json');
echo json_encode($result);


?>