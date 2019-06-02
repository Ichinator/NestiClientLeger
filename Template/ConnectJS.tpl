<script>
    $(function(){
        $("#connectButton").click(function () {

            var mail = $("#email").val();
            var password = $("#password").val();

            console.log("Voici un message");
            $.ajax({
                type: 'POST',
                url: "../Model/Users.php?",

                data: {functionToCall : "connectUser", mail : mail, password : password},
                success: function(data){

                    // Nous vérifions si un utilisateur est trouvé, si ce n'est pas le cas la chaîne de caractères doit comporter 2 caractères
                    // qui sont [ et ]
                    if(data.length === 2){
                        alert("Nous ne vous trouvons pas");
                    }else{
                        alert("Success : "+data)
                    }

                }
            });

            /*
            Pour une redirection éventuelle

            window.location = "http://localhost:8000/";
            alert(window.location.toString())
*/
        });
    });
</script>