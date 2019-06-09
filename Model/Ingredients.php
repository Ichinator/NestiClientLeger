<?php


function getIngredientsJoinCategories(){
    $result = null;
    try{

        $bdd = getPDO();
        $stmt = $bdd->prepare('SELECT * FROM Ingredients JOIN Categorie ON Categorie_Categorie = nomCategorie');
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        error_log("Erreur dans la fonction de connection : ".$e->getMessage());
    }

    return $result;
}