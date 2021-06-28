<!doctype html>
<html lang="fr">

<head>
	<title>Jeu des allumettes</title>
</head>

<body>
	<center>
		<?php
		require("fonctions.php"); // Je fais appel aux fonctions
		session_start(); // Je maintiens les variables de session
		// Si le joueur est identifié :
		$idJoueur = 0;
		if (isset($_SESSION["pseudo"])) {
			$jeuOrdinateur = 0; // Variable initialisée pour être utilisée dans des fonctions
			// Je crée un id de partie s'il n'existe pas encore
			$numPartie = $_POST["numPartie"] ?? 0;
			// Je récupère l'id du joueur grâce à son pseudo
			$idJoueur = RecupIdJoueur($_SESSION["pseudo"]);
			// Si le bouton "Rejouer" a été cliqué, j'ignore la valeur renvoyée
			if (($numPartie == 0) || isset($_POST["Rejouer"])) {
				$numPartie = NouvellePartie($idJoueur);
			}
			$alludebut = $_POST["alludebut"] ?? 15;
			// S'il a cliqué sur "Rejouer" :
			if (isset($_POST["Rejouer"])) {
				$allumettes = $alludebut; // On recommence avec le nombre d'allumette de départ
			} else {
				$allumettes = $_POST["allumettes"] ?? $alludebut; // On recommence avec le nombre d'allumette du formulaire
			}
			if ($allumettes == 0) { // Si la partie précédente est terminée
				$allumettes = $alludebut; // On recommence avec le nombre d'allumette de départ
				$numPartie = NouvellePartie($idJoueur);
			}
			// Si le joueur a cliqué sur un bouton "nombre d'allumettes" :
			$choixJoueur = $_POST["Jouer"] ?? 0;
			// On teste si le joueur n'a pas joué
			if ($choixJoueur == 0) {
				echo "<p>A vous de jouer !</p>";
				if (isset($_POST["Ordi"])) {
					JeuOrdinateur($jeuOrdinateur, $allumettes, $alludebut, $numPartie); // Fonction pour faire jouer l'ordi
				} else {
					$jeuOrdinateur = 0; // Ce n'est pas à l'ordi de jouer
				}
			} elseif ($choixJoueur >= $allumettes) { // Si le joueur a tout pris
				echo "<h1 style='color:red;'>Vous avez perdu !<br />CHEEEH !!!!</h1><br />";
				$choixJoueur = $allumettes; // Le choix du joueur ne peut dépasser le nombre restant d'allumettes !
				echo "<p>Le joueur a pris ", $choixJoueur, " allumettes.</p>";
				$allumettes = 0; // Il ne reste plus d'allumette
				$jeuOrdinateur = 0; // Du coup l'ordinateur ne peut pas en prendre...
			} else {
				$allumettes -= $choixJoueur; // Je retire les allumettes du Joueur
				echo "<p>Le joueur a pris ", $choixJoueur, " allumettes.</p>";
				JeuOrdinateur($jeuOrdinateur, $allumettes, $alludebut, $numPartie); // Fonction pour faire jouer l'ordi
			}
			// J'enregistre le coup dans l'historique
			EnregistrerHistorique($numPartie, $idJoueur, $allumettes, $choixJoueur, $jeuOrdinateur);
			echo "<h3>Joueur : ", $_SESSION["pseudo"], "</h3>";
			echo "<p>Celui qui prend la dernière allumette a perdu.</p>";
			echo '<br><img src="./images/alluperma.png" height=100> ';
			for ($i = 0; $i < $allumettes; $i++) { // Allumettes restantes
				echo '<img src="./images/allumette.png" height=100>';
			}
			for ($i = 0; $i < $jeuOrdinateur; $i++) { // Prises par l'ordi
				echo '<img src="./images/allumette2.png" height="100">';
			}
			for ($i = 0; $i < $choixJoueur; $i++) { // Prises par le joueur
				echo '<img src="./images/allumette3.png" height="100">';
			}
			echo ' <img src="./images/alluperma.png" height=100>';
		?>
			<form method="POST">
				<label>Prendre des d'allumettes :</label>
				<input type="submit" name="Jouer" value="1">
				<input type="submit" name="Jouer" value="2">
				<input type="submit" name="Jouer" value="3"><br />
				<label for="allumettes">Nombre d'allumettes :</label>
				<input type="number" name="allumettes" value="<?= $allumettes; ?>" style='width:40px'> sur <input type="number" name="alludebut" value="<?= $alludebut; ?>" style='width:40px'><br />
				<input type="hidden" name="numPartie" value="<?= $numPartie; ?>">
				<input type="submit" name="Rejouer" value="Rejouer">
				<input type="checkbox" name="Ordi" <?php if (!isset($_POST["allumettes"]) || isset($_POST["Ordi"])) echo "checked"; ?>> <label for="Ordi">L'ordinateur joue en premier</label>
			</form>
		<?php
		} else { // Si $_SESSION["pseudo"] n'existe pas
			echo "<p>Joueur non identifié.</p>";
		}
		?>
		<form action="login.php">
			<input type="submit" value="Accueil">
		</form>
		<?php
		AfficherHistorique($idJoueur);
		?>
	</center>

</body>

</html>