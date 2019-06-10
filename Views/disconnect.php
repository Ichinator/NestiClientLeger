<?php
session_start();

unset($_SESSION["userSession"]);
unset($_SESSION["panier"]);
unset($_SESSION["prix"]);
unset($_SESSION["mail"]);
?>

<p>Vous avez bien été déconnecté</p>
