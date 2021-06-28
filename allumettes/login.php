<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Page de login PHP</title>
    </head>
    <body>
      <?php
        session_start();
        // Méthode 1 :
        // $login="";
        // if (isset($_POST["login"])) {
        //    $login=$_POST["login"];
        // }
        // Méthode 2 :
        // $login=isset($_POST["login"])?$_POST["login"]:"";
        // Méthode 3 : (Merci Rémi)
        $login=$_POST["login"]??"";
        $mdp=$_POST["pwd"]??"";
        if (isset($_POST["DECONNEXION"])) { // Si bouton déconnexion
          unset($_SESSION["pseudo"]);
        } elseif (($login!="")&&($mdp!="")) {
          $connexion = new PDO("mysql:host=localhost:3306;dbname=tcu","root","");
          $sql = "SELECT pseudo FROM login_php WHERE login=:login AND mdp=:mdp;";
          $resultat = $connexion->prepare($sql);
          $resultat->execute([":login"=>$login,":mdp"=>$mdp]);
          $tableau = $resultat->fetch();
          if ($tableau) { // Si une ligne est renvoyée
            // Joueur identifié
            $_SESSION["pseudo"]=$tableau["pseudo"];
            echo "<h3>Bienvenue ",$_SESSION["pseudo"]," !</h3>";
          } else { // Si la requête échoue fetch retourne "false"
            // Joueur non identifié
            echo "<p>Login ou mot de passe incorrect.</p>";
          }
        }
       ?>
      <form method="POST">
     		<label for="login">Login :</label>
     		<input type="text" name="login" value="<?=$login ?>"><br />
     		<label for="mdp">Mot de passe :</label>
     		<input type="password" name="pwd"><br />
        <input type=submit value="Se connecter">
        <?php
          if (isset($_SESSION["pseudo"])) {
        ?>
            <input type=submit name="DECONNEXION" value="Se déconnecter">
          </form>
          <form method="POST" action="allumettes-v4.php">
            <input type=submit value="Jeu des allumettes">
        <?php
          }
        ?>
     	</form>
    </body>
</html>
