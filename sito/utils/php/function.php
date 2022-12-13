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

function addFile($file){
    try {
        if(!empty($file)){
            if (!isset($file['error']) || is_array($file['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
    
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
    
            if ($file['size'] > 10*1024*1024) {
                throw new RuntimeException('Exceeded filesize limit.: '.$file['size']);
            }
    
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($file['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
    
            $file_name=uniqid();
            if (!move_uploaded_file(
                $file['tmp_name'],
                sprintf('../../../img/post_img/%s.%s',
                    $file_name,
                    $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            $file_name .= ".".$ext;
        } else {
            $file_name = "";
        }
        $result["file"] = $file_name;
        return $result;
    } catch (RuntimeException $e) {
        $result["errore"]=$e->getMessage();
        return $result;
    }
}
?>