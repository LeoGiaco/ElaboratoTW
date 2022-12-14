<!DOCTYPE html>
<html lang="it" id="page-<?=$templateParams["pageid"]?>">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <base href="/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.js" integrity="sha256-8L3yX9qPmvWSDIIHB3WGTH4RZusxVA0DDmuAo4LjnOE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/tripledes.js" integrity="sha256-jY3gYjXgjzjdyFUHDvjLhtfGmmezpSePjL8q9ktVEi0=" crossorigin="anonymous"></script>
    <?php foreach($templateParams["javascript"] as $path):?>
        <script src="<?=$path?>"></script>
    <?php endforeach; ?>
    
    <script src="utils/js/function.js"></script>
    <title><?= $templateParams["title"] ?></title>
</head>
<body>
    <?php foreach($templateParams["pieces"] as $path)
        require_once $path;
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>