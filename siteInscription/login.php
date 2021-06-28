<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    $connexion = NEW PDO('mysql:host=localhost:3306;dbname=tcu', 'root', '');

    $sql = 'SELECT * FROM login_php;';

    $resultat = $connexion->query($sql);

    $tableau = $resultat->fetchAll();

    foreach($tableau as $ligne) {
        echo '<pre>';
        var_dump($ligne);
        echo '</pre>';
    }

?>
    
</body>
</html>