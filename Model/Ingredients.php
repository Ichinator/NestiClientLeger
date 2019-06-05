<?php


function getIngredientsJoinCategories($host, $util, $password, $bdd){
    $result = null;
    try{

        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
        $stmt = $bdd->prepare('SELECT * FROM Ingredients JOIN Categorie ON Categorie_Categorie = nomCategorie');
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        error_log("Erreur dans la fonction de connection : ".$e->getMessage());
    }

    return $result;
}