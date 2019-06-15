<?php

require_once "Connect.php";







function commander(){
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($_SESSION["panier"]));
    $result = null;
    try{

        $bdd = getPDO();

        foreach($iterator as $key=>$value) {
            $insertQuery = 'INSERT INTO Commandes (Client_idClient, Ingredients_idIng, EtatCommande_etat) VALUES (';
            $insertQuery .= $_SESSION["userSession"]["id"].', (SELECT idIng FROM Ingredients WHERE nom = "'.$key.'"), 1)';
            error_log($insertQuery);
            $stmt = $bdd->prepare($insertQuery);
            $stmt->execute();

            unset($insertQuery);
        }

    }catch (Exception $e){
        error_log("Erreur dans la fonction de commande : ".$e->getMessage());
    }

    return $result;
}