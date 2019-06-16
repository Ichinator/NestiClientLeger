<?php

    require_once "Connect.php";


    if(isset($_POST["functionToCall"])){
        error_log($_POST["functionToCall"]);
        echo $_POST["functionToCall"]();
    }

/**
 * Vérifie si un utilisateur est présent en base de données et s'il a le bon mot de passe. Si c'est le cas, on ajoute ses informations en session.
 */
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
            $_SESSION["userSession"]=$result[0];
            $_SESSION["mail"]=$result[0]["mail"];
        }

        echo json_encode($result);
    }

/**
 * Permet de créer de nouveaux comptes
 */
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

        error_log($mail);

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

/**
 * Mets à jour l'utilisateur
 */
function updateUser(){
    $password = $_POST["password"];

    session_start();


    $result = null;

    error_log($password);
    error_log($_SESSION["userSession"]["mdp"]);

    if($password == $_SESSION["userSession"]["mdp"]){
        error_log("Dans le if");
        try{
            $bdd = getPDO();
            $queryUpdate = 'UPDATE Utilisateurs SET nom = '.$bdd->quote($_POST["nom"]).', prenom = '.$bdd->quote($_POST["prenom"]).', ddn = '.$bdd->quote(date("Y-m-d", strtotime($_POST["dateNaissance"]))).', adresse = '.$bdd->quote($_POST["adresse"]).', Ville_idVille = '.$_POST["ville"].', mail = '.$bdd->quote($_POST["mail"]).' WHERE id = '.$_SESSION["userSession"]["id"];
            error_log($queryUpdate);
            $stmt = $bdd->prepare($queryUpdate);

            $stmt->execute();

            $result = "Votre compte a bien été modifié";
        }catch (Exception $e){
            error_log("Erreur dans la fonction de mise à jour d'utilisateur : ".$e->getMessage());
            $result = "Désolé nous n'avons pas pu modifié votre compte.";
        }
    }else{
        error_log("Dans le else");
        $result = "Mauvais mot de passe !";
    }

    echo $result;
}

function updatePassword(){
    error_log("update");
    $password = $_POST["password"];
    $passwordNew = $_POST["passwordNew"];
    $passwordNewConfirm = $_POST["passwordNewConfirm"];

    session_start();


    $result = null;

    if($password == $_SESSION["userSession"]["mdp"]){
        if($passwordNew === $passwordNewConfirm){
            try{
                $bdd = getPDO();
                $queryUpdate = 'UPDATE Utilisateurs SET mdp = '.$bdd->quote($_POST["passwordNew"]).' WHERE id = '.$_SESSION["userSession"]["id"];
                error_log($queryUpdate);
                $stmt = $bdd->prepare($queryUpdate);

                $stmt->execute();

                $result = "Votre compte a bien été modifié";
            }catch (Exception $e){
                error_log("Erreur dans la fonction de mise à jour du mot de passe utilisateur : ".$e->getMessage());
                $result = "Désolé nous n'avons pas pu modifié votre compte.";
            }
        }else{
            $result = "Mots de passe différents";
        }
    }else{
        $result = "Mauvais mot de passe !";
    }

    echo $result;
}
?>