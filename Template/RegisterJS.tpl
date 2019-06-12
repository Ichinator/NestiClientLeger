<script src="../Assets/jqueryUi/jquery-ui.js"></script>
<script>


    $( function() {
        $( "#datepicker" ).datepicker();


        /**
         * Requête ajax pour récupérer les villes qui correspondent à une chaîne de caractères
         */
        $( "#textVille" ).keyup(function() {
            valeur = $("#textVille").val();
            if(valeur.length > 3){
                $('#selectVille').empty();
                $.ajax({

                    type: "POST",
                    url: "../Model/Ville.php",
                    data: {functionToCall : "selectVille", partialString:valeur },
                    dataType: "json",
                    success: function (data) {
                       for(var i = 0; i < data.length; i++){
                           console.log(data[i]["idVille"]);
                           console.log(data[i]["ville"]);
                           //$("#selectVille").append('<option value="'+data[i]["idVille"]+'">'+data[i]["ville"]+'</option>')
                           $('#selectVille').append($('<option>', {
                               value: data[i]["idVille"],
                               text: data[i]["ville"]
                           }));
                       }
                    }
                    })
            }
        });
        /**
         * Requête ajax qui envoie les données de l'utilisateur à la fonction d'enregistrement
         */
        $("#registerButton").click(function () {
            var mail = $("#email").val();
            var password = $("#password").val();
            var passwordConfirm = $("#passwordConfirm").val();
            var dateNaissance = $("#datepicker").val();
            var nom = $("#nom").val();
            var prenom = $("#prenom").val();
            var adresse = $("#adresse").val();
            var ville = $("#selectVille").val();

            $.ajax({
                type: 'POST',
                url: "../Model/Users.php",
                datatype: "text",
                data: {functionToCall : "registerUser", mail : mail, password : password, passwordConfirm : passwordConfirm, dateNaissance : dateNaissance, nom : nom, prenom : prenom, adresse : adresse, ville : ville},
                success: function (data) {
                    alert(data);
                }
            })
        })
    } );
</script>