<script>
    $(function () {

        $(".btn").click(function () {

            var functionToCall;
            var idCours = $(this).attr("id");

            if($(this).hasClass("btn-primary")){
                functionToCall = "inscriptionCours";
                $(this).removeClass("btn-primary");
                $(this).addClass("btn-danger");
                $(this).html("Se désinscrire");
            }else{
                functionToCall = "desinscriptionCours";
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-primary");
                $(this).html("S'inscrire");
            }
            $.ajax({
                type: 'POST',
                url: "../Model/Cours.php",
                datatype: "text",
                data: {functionToCall : functionToCall, idCours : idCours},
                success: function (data) {
                    alert(data);
                }
            })
        });
    })
</script>