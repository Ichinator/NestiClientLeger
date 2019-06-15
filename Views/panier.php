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


    $_SESSION["prix"] = $prix;

?>




        <form action="/payment" method="post" id="payment-form">
            <div class="form-row">
                <label for="card-element">
                    Credit or debit card
                </label>
                <div>
                    <div style="width: 30em" id="card-element"></div>
                </div>
                <div>
                    <!-- Used to display Element errors -->
                    <span style="width: 30em; height: 2em; letter-spacing: 0em" id="card-errors" role="alert"></span>
                </div>
            </div>

            <button class="btn btn-primary">Payer <?= $prix ?> &euro;</button>
        </form>

    </div>
</div>
