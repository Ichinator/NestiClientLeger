<script>
    $(function () {
        $(".form-check-input").click(function () {
            if(this.checked){
                var checkInput = '.card.'+$(this).attr('id').replace(' ', '_');

                $(checkInput).show("fast");
               //    $(".")
            }else{
                var checkInput = '.card.'+$(this).attr('id').replace(' ', '_');

                $(checkInput).hide("fast");
            }
        });
        
        $(".btn-primary").click(function () {
            nom = $(this).siblings(".card-title").text();
            nombreProduits = $(this).siblings("input").val();

            $.ajax({
                url: "../Controller/Panier.php",
                data: {fonction : "ajouter", nom : nom, nombreProduits : nombreProduits},
                type: "POST",
                success: function () {
                    alert ("On prend "+nombreProduits+" "+nom);
                }
            })
        })
    })
</script>