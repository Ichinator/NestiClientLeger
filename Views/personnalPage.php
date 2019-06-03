<?php
require_once __DIR__."/../Model/Connect.php";
require_once __DIR__."/../Model/Users.php";
//On utilise l'id stocké en session pour faire la requête
session_start();
if(!is_nan($_SESSION["userSession"])){
    $result = selectAllDatasFromUser($_SESSION["userSession"], $host, $util, $password, $bdd);
    echo $result[0]["prenom"];
}
