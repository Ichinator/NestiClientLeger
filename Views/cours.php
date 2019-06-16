<?php
 require_once __DIR__."/../Model/Cours.php";

 $cours = selectAllCours();

 var_dump($cours);
 ?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Lieux</th>
        <th scope="col">Ville</th>
        <th scope="col">Horaire</th>
        <th scope="col">Cuisinier</th>
        <th scope="col">Recette</th>
        <th scope="col">Bouton</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $htmlString = "";

        foreach ($cours as $row){
            $nomCuisinier = $row["nom"];
            $prenomCuisinier = $row["prenom"];
            $lieux = $row["adresse"];
            $ville = $row["ville"];
            $recette = $row["nomRecette"];
            $horaire = $row["PlageHoraire_PlageHor"];
            $idCours = $row["idCours"];
           $estInscrit = verifierInscriptionCours($idCours);
           error_log("Est inscrit : ".$estInscrit);
            $htmlString .= "<tr>
        <td>".$lieux."</td>
        <td>".$ville."</td>
        <td>".$horaire."</td>
        <td>".$nomCuisinier." ".$prenomCuisinier."</td>
        <td>".$recette."</td>
        ";

            if($estInscrit){
                $htmlString .= "<td><button class='btn btn-danger' id='".$idCours."'>Se désincrire</button></td>
    </tr>";
            }else{
                $htmlString .= "<td><button class='btn btn-primary' id='".$idCours."'>S'inscrire</button></td>
    </tr>";
            }
        }

        echo $htmlString;
    ?>
    </tbody>
</table>
