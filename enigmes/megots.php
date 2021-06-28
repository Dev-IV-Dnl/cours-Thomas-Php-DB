<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get">
        <input type="number" name="megots" autofocus placeholder="Nombre de Mégots" autocomplete="off">
        <input type="submit">
    </form>

    <?php

    if(isset($_GET["megots"]) && $_GET["megots"]!="") {
        $nbMegots = $_GET["megots"];
        $megotParCigarette=4;
        $nbcigarettes = 0;
        $nbMegotsRestant = $nbMegots;


        while($nbMegotsRestant>=4) {
            $nbcigarettes = floor($nbMegotsRestant/$megotParCigarette);
            echo 'Je fabrique '.$nbcigarettes.' cigarettes avec '.$nbMegotsRestant.' mégots !<br>';
            $nbMegotsRestant = $nbMegotsRestant%$megotParCigarette+$nbcigarettes;
            echo 'Il me reste '.$nbMegotsRestant.' mégots !<br>';
        }
        echo 'terminé';
    }

    ?>
</body>
</html>
