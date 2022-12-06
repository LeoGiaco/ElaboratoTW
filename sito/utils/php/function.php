<?php
function ora($ore)
{
    if(!empty($ore))
    {
        $ore = substr($ore,0,5);
    }

    return $ore;
}

function dataIT($data)
{
    if(!empty($data))
    {
        $data = substr($data,8,2)."/".substr($data,5,2)."/".substr($data,0,4);
    }

    return $data;
}

function dataoraIT($data)
{
    if(!empty($data))
    {
        $data = substr($data,8,2)."/".substr($data,5,2)."/".substr($data,0,4)." ".substr($data,11,5);
    }

    return $data;
}

function dataUSA($data)
{
    if(!empty($data))
    {
        $data = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2);
    }

    return $data;
}

function dataoraUSA($data)
{
    if(!empty($data))
    {
        $data = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2)." ".substr($data,11,7);
    }

    return $data;
}

function today()
{
    return date("Y-m-d H:i:s");
}

function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

function getIdFromName($name){
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function isUserLoggedIn(){
    return !empty($_SESSION['user']);
}

function registerLoggedUser($user){
    $_SESSION["user"] = $user;
}


?>