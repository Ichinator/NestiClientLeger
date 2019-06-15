<?php
require_once __DIR__."/../Model/Commandes.php";

$commandes = commandesUtilisateur();


?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Ingrédient</th>
        <th scope="col">Catégorie de l'ingrédient</th>
        <th scope="col">Prix unitaire</th>
        <th scope="col">Prix de la commande</th>
        <th scope="col">Etat de la commande</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $htmlString = "";
        foreach ($commandes as $row){
            switch ($row["EtatCommande_etat"]){
                case '1':
                    $etat = "En cours de préparation";
                    break;
                case '2':
                    $etat = "En cours de livraison";
                    break;
                case '3':
                    $etat = "Livrée";
                    break;
            }
            $htmlString .= "<tr><td>".$row["nom"]."</td>
        <td>".$row["Categorie_Categorie"]."</td>
        <td>".$row["prix"]." &euro;</td>
        <td>".$row["prixCommande"]." &euro;</td>
        <td>".$etat."</td></tr>";
        }

        echo $htmlString;
    ?>
    </tbody>
</table>
