<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $templateParams["title"] ?></title>
</head>
<body>
    <?php foreach($templateParams["pieces"] as $path)
        require_once $path;
    ?>
</body>
</html>