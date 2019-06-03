<?php

    require_once "Connect.php";


    if(isset($_POST["functionToCall"])){
        echo $_POST["functionToCall"]($host, $util, $password, $bdd);
    }


    function connectUser($host, $util, $password, $bdd){
        $mailUser = $_POST["mail"];
        $passwordUser = $_POST["password"];

        $result = null;
        try{

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
            $stmt = $bdd->prepare('select * from Utilisateurs WHERE "'.$mailUser.'" = mail AND "'.$passwordUser.'" = mdp');
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            die("Erreur dans la fonction de connection : ".$e->getMessage());
        }




        if(!is_nan($result[0]["id"])){
            session_start();
            /*session is started if you don't write this line can't use $_Session  global variable*/
            $_SESSION["userSession"]=$result[0]["id"];
        }

        echo json_encode($result);
    }

    /*public function registerUser(){

}*/

    function selectAllDatasFromUser ($id, $host, $util, $password, $bdd){
        $id;

        $result = null;
        try{

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
            $stmt = $bdd->prepare('select * from Utilisateurs WHERE "'.$id.'" = id');
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            die("Erreur dans la fonction de connection : ".$e->getMessage());
        }

        return $result;
    }
?>