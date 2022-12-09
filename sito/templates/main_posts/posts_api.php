<?php
require("../../bootstrap.php");

if($_POST["request"] == "datiTipologie") {
    $rec = $dbh->getPostType();
    $result = $rec;
} else if ($_POST["request"] == "nuovoPost") {
    $msg_img = "";
    try {
        $result["errore"]=$_POST["file"];
        if(!empty($_POST["file"])){
            if (!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
    
            switch ($_FILES['file']['error']) {
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
    
            if ($_FILES['file']['size'] > 10*1024*1024) {
                throw new RuntimeException('Exceeded filesize limit.: '.$_FILES['file']['size']);
            }
    
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['file']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
    
            $file_name=sha1_file($_FILES['file']['tmp_name']);
            if (!move_uploaded_file(
                $_FILES['file']['tmp_name'],
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

        $postResult = $dbh->addPost($_SESSION["user"], $_POST["testo"], $_POST["tipo"], $_POST["titolo"], $file_name);
        if($postResult){
            $result["state"]=true;
        }
        else{
            $result["state"]=false;
            $result["msg"]="Post non inserito errore dati!";
        }
    } catch (RuntimeException $e) {
        $result["state"]=false;
        $result["msg"]=$e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($result);
?>