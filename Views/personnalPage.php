<?php
require_once __DIR__."/../Model/Connect.php";
require_once __DIR__."/../Model/Users.php";
//On utilise l'id stocké en session pour faire la requête
session_start();
if(isset($_SESSION["userSession"])){



    $result = selectAllDatasFromUser($_SESSION["userSession"]);


    echo "<label> Prénom : </label>".utf8_encode($result[0]["prenom"])."<br><label> Nom : </label> ".utf8_encode($result[0]["nom"])."<br><label>Mail : </label> ".utf8_encode($result[0]["mail"]);
}

?>