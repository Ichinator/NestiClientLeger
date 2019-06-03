<script>
    $(function(){
        $("#connectButton").click(function () {

            var mail = $("#email").val();
            var password = $("#password").val();

            console.log("Voici un message");

            $.ajax({
                type: 'POST',
                url: "../Model/Users.php",

                data: {functionToCall : "connectUser", mail : mail, password : password},
                dataType: "json",
                success: function(data){

                    // Nous vérifions si un utilisateur est trouvé, si ce n'est pas le cas la chaîne de caractères doit comporter 2 caractères
                    // qui sont [ et ]
                    if(data.length === 0){
                        alert("Désolé nous ne vous trouvons pas dans notre base de donnée");

                    }else{

                        alert("Bonjour : "+data[0]["prenom"]);

                        localStorage.setItem("id", data[0]["id"]);
                        localStorage.setItem("prenom", data[0]["prenom"])

                        window.location = "http://localhost:8000/";
                    }

                }
            });



        });
    });
</script>