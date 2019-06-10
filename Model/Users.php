<?php

    require_once "Connect.php";


    if(isset($_POST["functionToCall"])){
        echo $_POST["functionToCall"]();
    }


    function connectUser(){
        $mailUser = $_POST["mail"];
        $passwordUser = $_POST["password"];

        $result = null;
        try{

            $bdd = getPDO();
            $stmt = $bdd->prepare('select * from Utilisateurs WHERE "'.$mailUser.'" = mail AND "'.$passwordUser.'" = mdp');
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            error_log("Erreur dans la fonction de connection : ".$e->getMessage());
        }




        if(!is_nan($result[0]["id"])){
            session_start();
            /*session is started if you don't write this line can't use $_Session  global variable*/
            $_SESSION["userSession"]=$result[0]["id"];
            $_SESSION["mail"]=$result[0]["mail"];
        }

        echo json_encode($result);
    }

    // Création de nouveaux comptes
    function registerUser(){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];
        $mail = $_POST["mail"];
        $dateNaissance = $_POST["dateNaissance"];
        $passwordUser = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];
        $ville = intval($ville);

        //Conversion de la date pour qu'elle soit au bon format
        $dateNaissance = date("Y-m-d", strtotime($dateNaissance));

        $result = null;

            if($passwordUser !== $passwordConfirm){
                $result = "Les mots de passes sont différents !";
            }else{
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    try{
                        $bdd = getPDO();
                        $queryInsert = 'INSERT INTO Utilisateurs (nom, prenom, ddn, adresse, Ville_idVille, mdp, mail, isClient) VALUES ('.$bdd->quote($nom).','.$bdd->quote($prenom).','.$bdd->quote($dateNaissance).','.$bdd->quote($adresse).','.$bdd->quote($ville).','.$bdd->quote($passwordUser).','.$bdd->quote($mail).', 1)';
                        error_log($queryInsert);
                        $stmt = $bdd->prepare($queryInsert);

                        $stmt->execute();

                        $result = "Votre compte a bien été créé";
                    }catch (Exception $e){
                        error_log("Erreur dans la fonction d'enregistrement : ".$e->getMessage());
                        $result = "Désolé nous n'avons pas pu créer votre compte. Soit votre mail est déjà utilisé, soit nous avons un problème en interne.";
                    }
                }else{
                    $result = "Mail invalide !";
                }
            }


        echo $result;
}

    function selectAllDatasFromUser ($id){
        $id;

        $result = null;
        try{

            $bdd = getPDO();
            $stmt = $bdd->prepare("SELECT * FROM Utilisateurs WHERE id = ".$id);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            error_log("Erreur : ".$e->getMessage());
        }

        return $result;
    }
?>