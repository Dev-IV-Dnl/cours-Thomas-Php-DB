<?php

$listePrenom =
        [
            'Néo',
            'IV',
            'Rémi',
            'Emilie',
            'Terry',
            'Islam',
            'R2',
            'Kévin',
            'Marvin'
        ];
        $compteur=0;
        $listePrenomOrdre = $listePrenom;
        sort($listePrenomOrdre);


        for($compteur=0;$compteur<=8;$compteur++) {
            echo $listePrenomOrdre[$compteur].'<br>';

        }



?>