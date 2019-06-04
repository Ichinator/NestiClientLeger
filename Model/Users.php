<?php

    require_once "Connect.php";


    if(isset($_POST["functionToCall"])){
        echo $_POST["functionToCall"]($host, $util, $password, $bdd);
    }


    function connectUser($host, $util, $password, $bdd){
        $mailUser = $_POST["mail"];
        $passwordUser = $_POST["password"];

        $result = null;
        try{

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
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
        }

        echo json_encode($result);
    }

    // Création de nouveaux comptes
    function registerUser($host, $util, $password, $bdd){
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
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
                        $queryInsert = 'INSERT INTO Utilisateurs (nom, prenom, ddn, adresse, Ville_idVille, mdp, mail, isClient) VALUES ("'.$nom.'","'.$prenom.'","'.$dateNaissance.'","'.$adresse.'",'.$ville.',"'.$passwordUser.'","'.$mail.'", 1)';
                        error_log($queryInsert);
                        $stmt = $bdd->prepare($queryInsert);

                        $stmt->execute();

                        $result = "Votre compte a bien été créé";
                    }catch (Exception $e){
                        error_log("Erreur dans la fonction d'enregistrement : ".$e->getMessage());
                    }
                }else{
                    $result = "Mail invalide !";
                }
            }


        echo $result;
}

    function selectAllDatasFromUser ($id, $host, $util, $password, $bdd){
        $id;

        $result = null;
        try{

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$host.';dbname='.$bdd, $util, $password,$pdo_options);
            $stmt = $bdd->prepare();
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e){
            error_log("Erreur : ".$e->getMessage());
        }

        echo json_encode($result);
    }
?>