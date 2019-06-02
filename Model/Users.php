<?php

    //require_once "Connect.php";

$host= "localhost";
$util= "root";
$password= "140595Bilou1995";
$bdd= "Nesti";

    echo $_POST["functionToCall"]($host, $util, $password, $bdd);

    function connectUser($host, $util, $password, $bdd){
        $mailUser = $_POST["mail"];
        $passwordUser = $_POST["password"];

        $result = null;
        try{
            // on peut également utiliser include
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
            $stmt = $bdd->prepare('select * from Utilisateurs WHERE "'.$mailUser.'" = mail AND "'.$passwordUser.'" = mdp');
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            die("Erreur dans la fonction de connection : ".$e->getMessage());
        }
        echo json_encode($result);
    }

    /*public function registerUser(){

}*/
?>