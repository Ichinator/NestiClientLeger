<?php

echo $_POST["fonction"]();

function ajouter(){
    $nom = $_POST["nom"];
    $nombreProduits = $_POST["nombreProduits"];

    session_start();

    error_log("On commande ".$nombreProduits." ".$nom);



    // On vérifie si la session relative au panier existe ou non
    if(!isset($_SESSION["panier"])) {
        $monPanier = [];
        $_SESSION["panier"] = $monPanier;
    }
        // On récupère le contenu du panier actuel
        $monPanier = $_SESSION["panier"];

        // On vérifie si le panier est vide ou non
        if(empty($monPanier)){
            $monPanier[$nom] = $nombreProduits;
            $_SESSION["panier"] = $monPanier;
        }
        // Si il y a déjà l'ingrédient dans le panier, on ajoute juste la quantité sinon on
        // ajoute le nom du produit comme clé et le nombre comme valeur
        else if(array_key_exists($nom, $monPanier)){
            $monPanier[$nom] += $nombreProduits;
            $_SESSION["panier"] = $monPanier;
        }else{
            $monPanier[$nom] = $nombreProduits;
            $_SESSION["panier"] = $monPanier;
        }
}