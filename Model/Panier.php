<?php

require_once "Connect.php";

/**
 * @param $ingredient
 * @return array|null
 *
 * Sélectionne un prix en fonction d'un ingrédient
 */

function selectPrix($ingredient){

    $result = null;
    try{


        $bdd = getPDO();
        error_log($ingredient);
        $querySelect = 'select prix from Ingredients WHERE nom = "'.$ingredient.'"';
        error_log($querySelect);
        $stmt = $bdd->prepare($querySelect);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch (Exception $e){
        error_log("Erreur dans la fonction de sélection de prix : ".$e->getMessage());
    }

    return $result;
}