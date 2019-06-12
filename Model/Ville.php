<?php
require_once "Connect.php";


if(isset($_POST["functionToCall"])){
    echo $_POST["functionToCall"]();
}


/**
 * Recherche les villes qui contiennent une chaîne de caractères
 */
function selectVille(){
    $partialString = $_POST["partialString"];
    $partialString .= "%";
    error_log($partialString);
    $result = null;
    try{

        $bdd = getPDO();
        $stmt = $bdd->prepare('SELECT * FROM Ville WHERE ville LIKE "'.$partialString.'"');
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        die("Erreur dans la fonction de connection : ".$e->getMessage());
    }

    echo json_encode($result);
}