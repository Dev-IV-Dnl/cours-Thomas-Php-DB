<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>HASARD</title>
</head>

<body>
    <center>
    <div class="tout">
            <?php
            //version longue :
            // $face=6;
            // if(isset($_POST["faces"])){
            //     $face = $_POST["faces"];
            // }

            // version courte : 
            $faces = $_POST["faces"] ?? 6;

            if (isset($_POST["lancer"])) {
                for ($i = 1; $i <= $_POST["lancer"]; $i++) {
                    echo '<div class="cadre"> Dé numéro ' . $i . ' : <br> ', rand(1, $faces), '</div>';
                }
            }

            ?>
        </div><br><br>
        
        <form method="POST">
            <label for="">Nombre de Dés :</label><br>
            <input type="number" name="lancer" value="<?= $_POST["lancer"] ?? 1;?>" min="1"><br>
            <select name="faces" id="">
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="12">12</option>
                <option value="20">20</option>
            </select>
            <input type="submit" class="lancer" value="Lancer les Dés">
        </form>

    </center>

</body>

</html>