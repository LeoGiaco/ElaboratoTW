<?php
require("../../bootstrap.php");

if($_POST["request"] == "datiTipologie") {
    $rec = $dbh->getPostType();
    $result = $rec;
} else {
    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['file']['error']) ||
            is_array($_FILES['file']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }
    
        // Check $_FILES['file']['error'] value.
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
    
        // You should also check filesize here.
        if ($_FILES['file']['size'] > 5*1024*1024) {
            throw new RuntimeException('Exceeded filesize limit.: '.$_FILES['file']['size']);
        }
    
        // DO NOT TRUST $_FILES['file']['mime'] VALUE !!
        // Check MIME Type by yourself.
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
    
        // You should name it uniquely.
        // DO NOT USE $_FILES['file']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        if (!move_uploaded_file(
            $_FILES['file']['tmp_name'],
            sprintf('../../../img/post_img/%s.%s',
                sha1_file($_FILES['file']['tmp_name']),
                $ext
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
    
        echo 'File is uploaded successfully.';
    
    } catch (RuntimeException $e) {
    
        echo $e->getMessage();
    
    }
    

    // foreach ($_FILES["file"]["error"] as $key => $error) {
    //     if ($error == UPLOAD_ERR_OK) {
    //         $tmp_name = $_FILES["file"]["tmp_name"][$key];
    //         $name = basename($_FILES["file"]["name"][$key]);
    //         $result["prova"]=move_uploaded_file($tmp_name, "../../../img/post_img/"+$name);
    //     }
    // }
    // $postResult = $dbh->addPost($_SESSION["user"], $_POST["testo"], $_POST["tipo"], $_POST["titolo"], $_POST["immagine"]);
    // if($postResult){
    //     $result["state"]=true;
    // }
    // else{
    //     $result["state"]=false;
    //     $result["msg"]="Post non inserito errore!";
    // }
}

// $loginResult = $dbh->login($_POST["email"], $_POST["password"]);
// if(count($loginResult)==1){
//     $result["state"]=true;
//     registerLoggedUser($_POST["email"]);
// }
// else{
//     $result["state"]=false;
//     $result["msg"]="Password errata!";
// }

// $result["state"]=false;
// $result["msg"]="Errore! Mail inserita non presente!";

header('Content-Type: application/json');
echo json_encode($result);
?>