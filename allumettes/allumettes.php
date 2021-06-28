<!doctype html>
<html lang="fr">
<head>
	<title>Jeu des allumettes</title>
</head>
<body>
<center>
	<?php
		session_start();
		if (isset($_SESSION["pseudo"])) {
			$allumettes=$_POST["allumettes"]??15;
			if ($allumettes == 0) { $allumettes=15; }
			$choixJoueur=$_POST["Jouer"]??0;
			if ($choixJoueur>=$allumettes) {
				echo "Vous avez perdu !<br />Cheh !!!!<br />";
				$allumettes = 0;
			} else {
				$allumettes -= $choixJoueur; // Je retire les allumettes du Joueur
				$jeuOrdinateur = rand(1,3);
				if ($jeuOrdinateur>=$allumettes) {
					echo "Vous avez battu l'ordinateur !<br />Cheh !!!!<br />";
					$allumettes = 0;
				} else {
					$allumettes -= $jeuOrdinateur; // Je retire les allumettes de l'ordinateur
				}
			}
			// Je récupère l'id du joueur grâce à son pseudo
			$idJoueur = recupIdJoueur($_SESSION['pseudo']);
			//Je crée un id de partie s'il n'existe pas encore
			$numPartie = $_POST['numPartie'] ?? 0;
			if($_POST['numPartie']!=0) {
				$numPartie = $_POST['numPartie'];

			}

			echo "<h3>",$_SESSION["pseudo"],"</h3>";
			echo "<p>Celui qui prend la dernière allumette a perdu.</p>";
			for ($i=0;$i<$allumettes;$i++) { // Allumettes restantes
				echo '<img src="./images/allumette.png">';
			}
			for ($i=0;$i<$jeuOrdinateur;$i++) { // Prises par l'ordi
				echo '<img src="./images/allumette_cramee.png">';
			}
			for ($i=0;$i<$choixJoueur;$i++) { // Prises par le joueur
				echo '<img src="./images/allumette_cramee_plus.png">';
			}
	?>
	<form method="POST">
		<label>Prendre des d'allumettes :</label>
		<input type=submit name="Jouer" value="1">
		<input type=submit name="Jouer" value="2">
		<input type=submit name="Jouer" value="3">
		<label for="megots">Nombre d'allumettes :</label>
		<input type=number name="allumettes" value="<?=$allumettes; ?>">
		<input type=submit value="Rejouer">
	</form>
	<?php
		} else { // Si $_SESSION["pseudo"] n'existe pas
	?>
			<form action="login.php">
				<input type="submit" value="Accueil">
			</form>
	<?php
		}
	?>
</center>

</body>
</html>
