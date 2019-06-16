<script>
    $(function () {

        $(".btn").click(function () {

            var password = $("#password").val();
            var passwordNew = $("#passwordNew").val();
            var passwordNewConfirm = $("#passwordNewConfirm").val();

            if(passwordNew === passwordNewConfirm){
                $.ajax({
                    type: 'POST',
                    url: "../Model/Users.php",
                    datatype: "text",
                    data: {functionToCall : "updatePassword", password : password, passwordNew : passwordNew, passwordNewConfirm : passwordNewConfirm},
                    success: function (data) {
                        alert(data);
                    }
                })
            }else{
                alert("Mots de passe différents !");
            }

        });
    })
</script>