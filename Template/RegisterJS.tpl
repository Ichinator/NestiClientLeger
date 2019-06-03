<script src="../Assets/jqueryUi/jquery-ui.js"></script>
<script>

    // Step 1) Créer le datePicker
    $( function() {
        $( "#datepicker" ).datepicker();


    // Step 2) Requête ajax pour récupérer les villes en fonction d'une chaîne de caractère ( avec autocomplétion )
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
    // Step 3) Vérifier au front que les mots de passes correspondent et que le mail est valide

    // Step 4) Requête ajax pour créer l'utilisateur
    } );
</script>