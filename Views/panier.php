<div class="row">
    <div class="offset-2 col-8">

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
?>


        <form method="post" id="paymentForm">
            <div class="form-group" >
                <label>Numéro de carte</label>
                <input type="text" class="form-control" placeholder="Votre code de carte bleue" required>
            </div>
            <div class="form-group">
                <label>Mois de validité</label>
                <input type="text" class="form-control" placeholder="Mois de validité" required>
            </div>
            <div class="form-group">
                <label>Année de validité</label>
                <input type="text" class="form-control" placeholder="Année de validité" required>
            </div>
            <div class="form-group">
                <label>Cryptogramme</label>
                <input type="text" class="form-control" placeholder="Cryptogramme" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Payer <?= $prix; ?> &euro;</button>
        </form>

    </div>
</div>
