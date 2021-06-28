<!doctype html>
<html lang!"fr">
<head>
	<title>Un chameau et des bananes</title>
</head>
<body>
<center>
	<?php
	// Au début, j'ai un stock de 10 000 bananes
	$bananes = 10000;
	// Et j'ai 1000km à parcourir
	$km = 1000;
	// Mon chameau peut porter 1000 bananes au maximum
	$chargeMaxi = 1000;
	// Tous ces nombres de départ peuvent être modifiés par le formulaire
	if (isset($_GET["bananes"])) {
		$bananes = $_GET["bananes"];
		$km = $_GET["km"];
		$chargeMaxi = $_GET["maxi"];
	}
	// Je commence à 0 km
	$kmParcourus = 0;
	// Et je note que mon stock est plein
	$nbBananesRestantes = $bananes;
	// Au départ, chaque km parcouru me coûte 19 bananes (9 allers-retours = 18 + 1 aller simple = 19)
	$coutEnBananesActuel = ceil($nbBananesRestantes / $chargeMaxi)*2-1;
	// Tant qu'il me reste des bananes ou des km à parcourir
	while (($nbBananesRestantes>0)&&($kmParcourus<$km)) {
		// Je recalcule le côut du km en bananes : Mon stock divisé par la charge maxi du chameau, fois 2 (aller-retour) - 1 (pas de retour au dernier voyage)
		$coutEnBananes = ceil($nbBananesRestantes / $chargeMaxi)*2-1;
		// Si le coût au km change...
		if ($coutEnBananes!=$coutEnBananesActuel) {
			// ... J'affiche un point d'étape
			echo "J'ai parcouru $kmParcourus km, et il me reste $nbBananesRestantes bananes !<br />";
			// Et je note le nouveau coût au km
			$coutEnBananesActuel = $coutEnBananes;
		}
		// Je retire du stock la consommation du chameau
		$nbBananesRestantes -= $coutEnBananes;
		// J'ajoute 1 km au total parcouru
		$kmParcourus++;
	}
	// Si je suis à court de bananes ou à l'arrivée, j'affiche le résultat
	echo "J'ai parcouru $kmParcourus km, et il me reste $nbBananesRestantes bananes !";
	?>
	<form>
		<label for="bananes">Nombre de bananes :</label>
		<input type=number name="bananes" value="<?=$bananes ?>"><br />
		<label for="km">Nombre de kilomètres :</label>
		<input type=number name="km" value="<?=$km ?>"><br />
		<label for="maxi">Charge de bananes maxi :</label>
		<input type=number name="maxi" value="<?=$chargeMaxi ?>"><br />
		<input type=submit value="Calculer">
	</form>
</center>

</body>
</html>
