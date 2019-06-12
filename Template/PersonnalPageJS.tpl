<script src="../Assets/jqueryUi/jquery-ui.js"></script>
<script>
    $(function () {



        $( "#datepicker" ).datepicker();


        /**
         * A chaque fois que nous appuyons sur une touche dans le champ de recheerche de ville, s'il y a plus de trois lettres on récupère la chaîne de caractères
         * et on l'envoie en ajax à la fonction de recherche. Ensuite on affiche le résultat dans un champ de sélection.
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
         * Au click sur le bouton, nous récupérons les données entrées par l'utilisateur et nous les envoyons à
         * la fonction qui se charge de faire la mise à jour de cet utilisateur.
         */
        $("#submitButton").click(function () {
            console.log("click");
            var nom = $("#nom").val();
            var prenom = $("#prenom").val();
            var adresse = $("#adresse").val();
            var mail = $("#mail").val();
            var ville = $("#selectVille").val();
            var dateNaissance = $("#datepicker").val();
            var password = $("#password").val();


            console.log(nom+" "+prenom+" "+adresse+" "+mail+" "+ville+" "+dateNaissance+" "+password);

            $.ajax({
                type: 'POST',
                url: "../Model/Users.php",
                datatype: "text",
                data: {functionToCall : "updateUser", mail : mail, password : password,
                dateNaissance : dateNaissance, nom : nom, prenom : prenom, adresse : adresse, ville : ville},
                success: function (data) {
                    alert(data);
                },
                error: function(jqxhr, status, exception) {
                    console.log('Exception:'+ exception);
                    console.log("jqxhr : "+jqxhr);
                    console.log("status + "+status);
                }
            })
        });
    })
</script>