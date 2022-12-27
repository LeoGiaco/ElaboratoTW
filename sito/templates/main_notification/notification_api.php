<?php

require("../../bootstrap.php");

$result = array();
if(isset($_POST["request"])){
    switch ($_POST["request"]) {
        case "getNotifications":
            if(isUserLoggedIn()){
                $rec = $dbh->getNotifications($_SESSION["user"]);
                $old=array();
                $new=array();
                foreach ($rec as $val) {
                    if($val["Visualizzata"]==1){
                        $val["Data"]=dataoraIT($val["Data"]);
                        array_push($old, $val);
                    } else {
                        $val["Data"]=dataoraIT($val["Data"]);
                        array_push($new, $val);
                    }
                }
                $result["dati"]["new"] = $new;
                $result["dati"]["old"] = $old;
            }
            break;
        case "setOld":
            if(isUserLoggedIn()){
                $dbh->setOld($_SESSION["user"]);
            }
            break;
        case "delate":
            if(isUserLoggedIn()){
                $dbh->delateNotifications($_SESSION["user"]);
            }
            break;
    }
}
header('Content-Type: application/json');
echo json_encode($result);


?>