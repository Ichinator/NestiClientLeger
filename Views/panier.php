<?php
    require_once __DIR__."/../Model/Panier.php";

    $monPanier = $_SESSION["panier"];


    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($monPanier));

    $prix = 0;

    foreach($iterator as $key=>$value) {
        echo $value.' '.$key.'<br />';
        $prixSelectionne = selectPrix($key);

        $prixSelectionne = $prixSelectionne[0]["prix"];
        error_log("Prix selectionné : ".$prixSelectionne);
        $prix += $value * $prixSelectionne;
    }



    echo "<button class=\"btn btn-primary\"> Payer ".$prix."&euro;</button>"
?>


