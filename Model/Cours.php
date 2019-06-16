<?php
 require_once __DIR__."/Connect.php";

 if(isset($_POST["functionToCall"])){
     echo $_POST["functionToCall"]($_POST["idCours"]);
 }

 function selectAllCours(){
     $result = null;
     try{

         $bdd = getPDO();
         $querySelect = 'SELECT *, Recette.nom AS nomRecette, Cours.id AS idCours  FROM Cours JOIN Recette ON Recette_idRec = idRec JOIN Utilisateurs ON Cuisinier_idCuisinier = Utilisateurs.id JOIN (SELECT * FROM Lieux JOIN Ville ON Ville_idVille = idVille) AS jointureVilleLieux  ON Lieux_idLieux = idLieux';
         error_log($querySelect);
         $stmt = $bdd->prepare($querySelect);
         $stmt->execute();

         // set the resulting array to associative
         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }catch (Exception $e){
         error_log("Erreur dans la fonction de connection : ".$e->getMessage());
     }

     return $result;
 }

 function verifierInscriptionCours($idCours){
     $result = false;

     try{
         $bdd = getPDO();
         $querySelect = 'SELECT * FROM Utilisateurs_has_Cours WHERE idUtilisateur = "'.$_SESSION["userSession"]["id"].'" AND idCours = "'.$idCours.'"';
         $stmt = $bdd->prepare($querySelect);
         $stmt->execute();

         $resultatTableau = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($resultatTableau)){
            $result = true;
        }
     }catch(Exception $e){
         error_log("Erreur dans la vérification de vérification de l'inscription à un cours ".$e->getMessage());
     }
     error_log(json_encode($result));
     return $result;
 }

 function inscriptionCours($idCours){
     session_start();


     try{
         $bdd = getPDO();

         $queryInsert = 'INSERT INTO Utilisateurs_has_Cours VALUES ("'.$_SESSION["userSession"]["id"].'","'.$idCours.'")';
         error_log($queryInsert);
         $stmt = $bdd->prepare($queryInsert);
         $stmt->execute();

         $result = "Vous avez bien été inscrit";
     }catch(Exception $e){
         $result = "Désolé nous avons rencontré un problème";
         error_log("Erreur dans la fonction d'inscription à un cours ".$e->getMessage());
     }

     echo $result;
 }

function desinscriptionCours($idCours){
    session_start();


    try{
        $bdd = getPDO();

        $queryInsert = 'DELETE FROM Utilisateurs_has_Cours WHERE idUtilisateur = "'.$_SESSION["userSession"]["id"].'" AND idCours = "'.$idCours.'"';
        error_log($queryInsert);
        $stmt = $bdd->prepare($queryInsert);
        $stmt->execute();

        $result = "Vous avez bien été désinscrit";
    }catch(Exception $e){
        $result = "Désolé nous avons rencontré un problème";
        error_log("Erreur dans la fonction de désinscription à un cours ".$e->getMessage());
    }

    echo $result;
}
?>
