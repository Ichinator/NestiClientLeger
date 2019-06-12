<?php
require_once __DIR__."/../Model/Connect.php";
require_once __DIR__."/../Model/Users.php";
//On utilise l'id stocké en session pour faire la requête
if(isset($_SESSION["userSession"])){



    echo "<label> Prénom : </label>".utf8_encode($_SESSION["userSession"]["prenom"])."<br><label> Nom : </label> ".utf8_encode($_SESSION["userSession"]["nom"])."<br><label>Mail : </label> ".utf8_encode($_SESSION["userSession"]["mail"]);
}

?>

<form>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" placeholder="Entrer votre nom" value="<?= $_SESSION["userSession"]["nom"] ?>">
    </div>
    <div class="form-group">
        <label for="prenom">Prenom</label>
        <input type="text" class="form-control" id="prenom" placeholder="Entrer votre prénom" value="<?= $_SESSION["userSession"]["prenom"] ?>">
    </div>

    <div class="form-group">
        <label for="datepicker">Votre date de naissance</label>
        <input type="text" id="datepicker" class="form-control" value="<?= date("m/d/Y", strtotime($_SESSION["userSession"]["ddn"])) ?>">
    </div>


    <div class="form-group">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse"  placeholder="Entrer votre adresse" value="<?= $_SESSION["userSession"]["adresse"] ?>">
    </div>

    <div class="form-group">
        <label for="textVille">Votre ville</label>
        <input type="text" id="textVille" class="form-control">
        <select id="selectVille">
        </select>
    </div>

    <div class="form-group">
        <label for="mail">Adresse Email</label>
        <input type="email" class="form-control" id="mail" placeholder="Entrer votre adresse email" value="<?= $_SESSION["userSession"]["mail"] ?>">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe </label>
        <input type="password" class="form-control" id="password" placeholder="Entrer votre mot de passe">
    </div>
    <button type="submit" class="btn btn-primary" id="submitButton">Sauvegarder</button>
</form>
