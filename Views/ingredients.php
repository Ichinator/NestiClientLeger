<?php
require_once __DIR__.'/../Model/Ingredients.php';

$i = 0;
$result = getIngredientsJoinCategories();
$categories = [];
foreach ($result as $row){
    array_push($categories, $row["Categorie_Categorie"]);

}
$categories = array_unique($categories);
?>

<div class="row">
    <div class="col-3 alert alert-success">
        <form>
            <div class="form-group">
        <!-- ici on mettra une checkbox pour chaque catégorie -->
        <?php
        $chaineCategories = "";
            foreach ($categories as $cat){
                $chaineCategories .= "<div class=\"form-check\"><input type=\"checkbox\" id=\"".$cat."\" name=\"".$cat."\" class=\"form-check-input\" checked>
  <label for=\"scales\" class=\"form-check-label\">".$cat."</label></div>";

            }
        echo utf8_encode($chaineCategories);
        ?>
            </div>
        </form>
    </div>

        <!-- ici on mettra les fiches des ingrédients ( avec un modal pour la description ),
        les ingrédients visibles seront ceux dont la catégorie sera cochée -->
<div class="col-9 alert alert-primary">
    <div class="row">


        <?php

        $chaineIngredients = "";
        foreach ($result as $row){
            $modalId = "#modal".$row["nom"];
            $nomCat = $row["Categorie_Categorie"];
            $nomCat  = str_replace(' ', '_', $nomCat);

            $chaineIngredients .= "<div class=\"col-4\">
<div class=\"card ".$nomCat."\" style=\"width:350px\">
  <img class=\"card-img-top\" src=\"img_avatar1.png\" alt=\"Card image\">
  <div class=\"card-body\">
    <h4 class=\"card-title\">".$row["nom"]."</h4>
    <p class=\"card-text\">".$row["description"]."</p>
    
    <button class=\"btn btn-primary\">Ajouter au panier</button>
    <span>Prix : ".$row["prix"]." &euro;</span>
    <input type=\"text\" placeholder=\"Nombre de ".$row["nom"]."\">
  </div>
</div>
</div>
";


        }
        echo utf8_encode($chaineIngredients);
        ?>
    </div>
</div>
</div>