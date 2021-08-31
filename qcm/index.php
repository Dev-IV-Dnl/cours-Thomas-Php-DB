<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./infamie.css">
    <title>Document</title>
</head>

<body>

    <?php
    // pour afficher ABCD en boucle :
    // foreach(range('A','D') as $j) {
    //     echo $j;
    // }

    $question[1] = "Qu’est-ce qu’un algorithme ?";
    $reponse[1]["A"] = "Un organigramme";
    $reponse[1]["B"] = "Un organigramme ou un pseudocode";
    $reponse[1]["C"] = "Une décision";
    $reponse[1]["D"] = "Des instructions pas à pas utilisées pour résoudre un problème";
    $solution[1] = "D";

    $question[2] = "Quelles sont les trois constructions d’algorithme ?";
    $reponse[2]["A"] = "Entrée, Sortie, Processus";
    $reponse[2]["B"] = "Séquence, Sélection, Répétition";
    $reponse[2]["C"] = "Entrée / Sortie, Décision, Répétition";
    $reponse[2]["D"] = "Boucle, Entrée/Sortie, Processus";
    $solution[2] = "B";

    $question[3] = "Quelle est la différence entre un organigramme et un pseudocode ?";
    $reponse[3]["A"] = "Un organigramme est schématique tandis que le pseudocode est écrit dans un langage de programmation (par exemple, Pascal ou Java)";
    $reponse[3]["B"] = "Un organigramme est textuel mais le pseudocode est schématique";
    $reponse[3]["C"] = "Un organigramme est une description schématique d’un algorithme, tandis que le pseudocode est une description textuelle d’un algorithme.";
    $reponse[3]["D"] = "Un organigramme et un pseudocode sont pareils";
    $solution[3] = "C";

    $question[4] = "Dans un organigramme, une instruction d’entrée ou de sortie est représentée par _____ ?";
    $reponse[4]["A"] = "Un losange";
    $reponse[4]["B"] = "Un rectangle";
    $reponse[4]["C"] = "Un parallélogramme";
    $reponse[4]["D"] = "Un cercle";
    $solution[4] = "C";

    $question[5] = "Dans un organigramme, un calcul (processus) est représenté par _____ ?";
    $reponse[5]["A"] = "Un losange";
    $reponse[5]["B"] = "Un rectangle";
    $reponse[5]["C"] = "Un parallélogramme";
    $reponse[5]["D"] = "Un cercle";
    $solution[5] = "B";

    $question[6] = "Pour répéter une tâche, nous utilisons une ____ ?";
    $reponse[6]["A"] = "Entrée";
    $reponse[6]["B"] = "Condition";
    $reponse[6]["C"] = "Boucle";
    $reponse[6]["D"] = "Sortie";
    $solution[6] = "C";

    $question[7] = "Si ....... Alors ....... Sinon ....... Fin Si vérifie ____ ?";
    $reponse[7]["A"] = "Une seul condition";
    $reponse[7]["B"] = "Deux conditions";
    $reponse[7]["C"] = "Trois conditions";
    $reponse[7]["D"] = "Plusieurs conditions";
    $solution[7] = "B";

    $question[8] = "RÉPÉTER <traitement> JUSQU’À <condition> est une ______ ?";
    $reponse[8]["A"] = "Boucle positive";
    $reponse[8]["B"] = "Boucle négative";
    $solution[8] = "A";

    $question[9] = "Un organigramme doit représenter la situation dans laquelle, pour chaque note, un élève reçoit la mention «Bien» ou «Passable» le système considérera la note et s’il est égal ou supérieur à 12, attribue la mention «Bien», sinon il attribue la mention «Passable». Laquelle des options suivantes sera utilisé?";
    $reponse[9]["A"] = "Entrée";
    $reponse[9]["B"] = "Condition";
    $reponse[9]["C"] = "Boucle";
    $reponse[9]["D"] = "Sortie";
    $solution[9] = "B";

    $question[10] = "Qu’est-ce qu’un organigramme ?";
    $reponse[10]["A"] = "Un moyen de concevoir un algorithme basé sur du texte";
    $reponse[10]["B"] = "Un langage de programmation spécifique";
    $reponse[10]["C"] = "Un diagramme qui représente un ensemble d’instructions";
    $reponse[10]["D"] = "Un schéma d’instructions";
    $solution[10] = "C";
    ?>
    <h1>Nouveau défi, le QCM fonctionnel le plus horrible au monde : Bonne chance !</h1>
    <form method="POST">
        <?php
        foreach ($question as $i => $q) {
        ?>
            <h4><?php echo $i . '. ' . $q; ?></h4>
            <?php
            foreach ($reponse[$i] as $index => $rep) {
            ?>
                <input class="check" <?= (isset($_POST["choix" . $i]) && ($_POST["choix" . $i] == $index) ? " checked" : ""); ?> type="checkbox" id="test1" name="choix<?php echo $i; ?>" value="<?php echo $index; ?>"><?php echo $index; ?> : <?php echo $rep; ?><br>
            <?Php
            }
            if (!isset($_POST["choix" . $i])) {
                echo "<br><h2>Vous devez cocher une case pour valider la réponse !</h2>";
            } else {
                if ($solution[$i] == $_POST["choix" . $i]) {
                    echo "<h2 class='good'>Bonne réponse, c'était bien la réponse : " . $_POST["choix" . $i] . "</h2>";
                } else {
                    echo "<h2 class='bad'>Mauvaise réponse, la bonne est la réponse : " . $solution[$i] . "</h2>";
                }
            }
            ?>
        <?php
        }
        ?>
        <br><input class="submit" type="submit" value="Valide tes bêtises !">
    </form>

</body>

</html>