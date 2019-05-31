<script>
    $(function(){
        $("#connectButton").click(function () {

            var mail = $("#email").val();
            var password = $("#password").val();

            console.log("Voici un message");
            $.ajax({
                type: 'POST',
                url: "../Model/Users.php",
                data: "function=connectUser?action=connectUsers",
                success: function(data){
                    alert("Success : "+data)
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