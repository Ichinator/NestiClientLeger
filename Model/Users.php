<?php

    require_once __DIR__."Connect.php";

    public function connectUser($mail, $password){
        $response = null;
        try{
            // on peut également utiliser include
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
            $response = $bdd->query('select * from Clients WHERE mail = '.$mail.'AND mdp = '.$password);
        }catch (Exception $e){
            die("Erreur dans la fonction de connection : ".$e->getMessage());
        }
        return json_encode($response);
    }

    /*public function registerUser(){

}*/
?>