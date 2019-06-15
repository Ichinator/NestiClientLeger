<?php

require_once "Connect.php";







function commander(){
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($_SESSION["panier"]));
    $result = null;
    try{

        $bdd = getPDO();

        foreach($iterator as $key=>$value) {
            $insertQuery = 'INSERT INTO Commandes (Client_idClient, Ingredients_idIng, EtatCommande_etat, prixCommande) VALUES (';
            $insertQuery .= $_SESSION["userSession"]["id"].', (SELECT idIng FROM Ingredients WHERE nom = "'.$key.'"), 1, (SELECT prix FROM Ingredients WHERE nom = "'.$key.'") * '.$value.')';
            error_log($insertQuery);
            $stmt = $bdd->prepare($insertQuery);
            $stmt->execute();

            unset($insertQuery);
        }

        unset($_SESSION["panier"]);

        header("Location : http://localhost:8000/panier");
        Exit();
    }catch (Exception $e){
        error_log("Erreur dans la fonction de commande : ".$e->getMessage());
    }

    return $result;
}

function commandesUtilisateur(){
    $result = null;
    try{

        $bdd = getPDO();
        $stmt = $bdd->prepare('SELECT EtatCommande_etat, prixCommande, nom, Categorie_Categorie, prix FROM Commandes JOIN Ingredients ON Ingredients_idIng = idIng WHERE Client_idClient = '.$_SESSION["userSession"]["id"]);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        error_log("Erreur dans la fonction de recherche des commandes de l'utilisateur : ".$e->getMessage());
    }

    return $result;
}