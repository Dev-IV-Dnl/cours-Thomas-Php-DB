<?php
    // Fonctions :

    function AfficherHistorique($idJoueur) {
      $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
      $sql = "SELECT num_partie, nb_joueur, nb_ordi, score FROM historique JOIN score ON historique.num_partie = score.id WHERE score.id_joueur=:id_joueur;";
      $resultat = $connexion->prepare($sql);
      $resultat->execute([":id_joueur"=>$idJoueur]);
      $tableau = $resultat->fetchAll();
      echo "<table border=1 style='display:block;height:300px;width:180px;overflow:auto;'>
      <tr>
      <th>Partie</th>
      <th bgcolor='lightblue' colspan=4>Joueur</th>
      <th colspan=4>Ordi</th>";
      // Je donne au numéro de partie la valeur 0 pour commencer
      $partie = 0;
      // Je parcours les lignes de l'historique
      foreach($tableau as $ligne) {
        // Je récupère le numéro de la partie
        $nouvellePartie = $ligne["num_partie"];
        if ($partie!=$nouvellePartie) { // Si ce n'est pas le même que pour la ligne précédente
          // Je ferme la ligne en cours et j'en recommence une avec le nouveau numéro
          echo "</tr>
          <tr><td bgcolor='lightyellow'>",$nouvellePartie,"(".$ligne["score"].")</td>";
          $partie = $nouvellePartie;
        }
        if ($ligne["nb_joueur"] != 0) { // Si le joueur a joué ce coup
          // Je l'affiche en bleu
          echo "<td bgcolor='lightblue'>",$ligne["nb_joueur"],"</td>";
        }
        if ($ligne["nb_ordi"] != 0) { // Si l'ordinateur a joué ce coup
          // Je l'affiche en blanc
          echo "<td>",$ligne["nb_ordi"],"</td>";
        }
      }
      echo "</tr>
      </table>";
    }

    function JeuOrdinateur(&$jeuOrdinateur,&$allumettes,$alludebut,$numPartie) {
			$jeuOrdinateur = ($allumettes-1)%4; // Calcul du jeu de l'ordinateur gagnant...
			if ($jeuOrdinateur == 0) $jeuOrdinateur = rand(1,3); // ... si c'est possible
			if ($jeuOrdinateur>=$allumettes) {
				echo "Vous avez battu l'ordinateur !<br />Cheh !!!!<br />";
        // J'enregistre le score
        $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
        $sql = "UPDATE score SET score=$alludebut WHERE id=$numPartie;";
        $connexion->query($sql);
        echo "<p>Vous avez marqué ",$alludebut," points !</p>";
				$jeuOrdinateur = $allumettes;
        $allumettes = 0;
			} else {
				$allumettes -= $jeuOrdinateur; // Je retire les allumettes de l'ordinateur
			}
      echo "<p>L'ordinateur a joué ",$jeuOrdinateur," allumettes.</p>";
		}

    function EnregistrerHistorique($numPartie,$idJoueur,$allumettes,$choixJoueur,$jeuOrdinateur) {
      try {
        $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
        //$sql = "INSERT INTO historique (num_partie,id_joueur,allumettes,nb_joueur,nb_ordi) VALUES (:num_partie,:id_joueur,:allumettes,:nb_joueur,:nb_ordi);";
        //$resultat = $connexion->prepare($sql);
        //$test = $resultat->execute([":num_partie"=>$numPartie,":id_joueur"=>$idJoueur,":allumettes"=>$allumettes,":nb_joueur"=>$choixJoueur,":nb_ordi"=>$jeuOrdinateur]);
        $sql = "INSERT INTO historique (num_partie,id_joueur,allumettes,nb_joueur,nb_ordi) VALUES ($numPartie,$idJoueur,$allumettes,$choixJoueur,$jeuOrdinateur);";
        $resultat = $connexion->query($sql);
        //$sql2 = "SELECT MAX(id) FROM historique;";
        //$connexion->query($sql2);
        //$tableau = $resultat->fetch();
        //echo "%%",$tableau[0],"%%";
        //return $tableau[0];
      }
      catch (exception $e) {
          //code to handle the exception
          echo $e->getMessage();
      }
    }

    function RecupIdJoueur($pseudo) {
      $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
      $sql = "SELECT id FROM login_php WHERE pseudo=:pseudo;";
      $resultat = $connexion->prepare($sql);
      $resultat->execute([":pseudo"=>$pseudo]);
      $tableau = $resultat->fetch();
      return $tableau[0];
    }

    function NouvellePartie($idJoueur) {
      $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
      //$sql = "INSERT INTO scores (id_joueur,score) VALUES (:id_joueur,:score);";
      //$resultat = $connexion->prepare($sql);
      //$resultat->execute([":id_joueur"=>$idJoueur,":score"=>0]);
      $sql = "INSERT INTO score (id_joueur,score) VALUES ($idJoueur,0);";
      $connexion->query($sql);
      $sql2 = "SELECT LAST_INSERT_ID();";
      $resultat = $connexion->query($sql2);
      $tableau = $resultat->fetch();
      return $tableau[0];
    }
