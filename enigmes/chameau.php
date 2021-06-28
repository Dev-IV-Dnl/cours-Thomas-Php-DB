<center>
<h1>Le chameau et les bananes</h1>

<?php

//au début j'ai un stock 10000 bananes
$bananes=10000;
//j'ai 1000 km à parcourir
$km=1000;
//Le chameau peut porter 1000 bananes au maximum
$chargeMaxi=1000;

if(isset($_GET["bananes"]) && $_GET["bananes"]!="") {
    $bananes=$_GET["bananes"];
    $km=$_GET["km"];
    //je commence à 0 km
    $kmParcourus=0;
    // Et je note que mon stock est plein
    $nbBananesRestantes = $bananes;
    //Au départ, chaque km paroucru me coûte 19 bananes (9 allé-retours = 18+1 allé simple = 19)

    $coutEnBananesActuel = ceil($nbBananesRestantes/$chargeMaxi)*2+1;
    //Tant qu'il me reste des bananes ou des km à parcourir, je répète la boucle
    while(($nbBananesRestantes>0) && $kmParcourus<$km) {
        
        $coutEnBananes = ceil($nbBananesRestantes/$chargeMaxi)*2-1;
        $nbBananesRestantes -= $coutEnBananes;
        $kmParcourus++;
    }
}

?>

<form method="get">
    <input type="number" name="bananes" value="<?=$bananes;?>" placeholder="Nombre de bananes..." autofocus><br>
    <input type="number" name="km" value="<?=$km?>" placeholder="Nombre de KM..."><br>
    <input type="number" name="chargeMaxi" value="<?=$chargeMaxi;?>" placeholder="Charge Maximum de bananes..."><br>
    <input type="submit" value="Calculer">
</form>

<?php

    echo 'A l\'arrrivée, il reste '.$nbBananesRestantes.' bananes et un nombre non négligeable cadavres de chameaux sur le chemin... C\'est les vautours qui vont se régaler !';

?>
</center>