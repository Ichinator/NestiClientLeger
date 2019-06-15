<?php

require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../Model/Commandes.php";



error_log("paiement");
$key = "sk_test_a08TxCGXhpCAgjfjYmaKxDVb00i4RO3PIf";

\Stripe\Stripe::setApiKey($key);

\Stripe\Customer::create(array(
    'description'=>'Commande ',

    'email'=>$_SESSION["mail"]
));

$charge = \Stripe\Charge::create(array(
    'amount'=>$_SESSION["prix"] * 100,
    'currency'=>'eur',
    'source'=>$_POST["stripeToken"],
    'description'=>'client'
));

commander();