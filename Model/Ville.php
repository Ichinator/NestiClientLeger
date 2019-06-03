<?php
require_once "Connect.php";


if(isset($_POST["functionToCall"])){
    echo $_POST["functionToCall"]($host, $util, $password, $bdd);
}


/**
 * @param $host
 * @param $util
 * @param $password
 * @param $bdd
 */
function selectVille($host, $util, $password, $bdd){
    $partialString = $_POST["partialString"];
    $partialString .= "%";
    error_log($partialString);
    $result = null;
    try{

        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
        $stmt = $bdd->prepare('SELECT * FROM Ville WHERE ville LIKE "'.$partialString.'"');
        //$stmt = $bdd->prepare('select * from Utilisateurs WHERE "'.$mailUser.'" = mail AND "'.$passwordUser.'" = mdp');
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        die("Erreur dans la fonction de connection : ".$e->getMessage());
    }

    echo json_encode($result);
}