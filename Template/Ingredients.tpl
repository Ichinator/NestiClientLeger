<script>
    $(function () {
        $(".form-check-input").click(function () {
            console.log($(this).attr('id').replace(' ', '_'));
            if(this.checked){
                var checkInput = '.card.'+$(this).attr('id').replace(' ', '_');

                $(checkInput).show("fast");
               //    $(".")
            }else{
                var checkInput = '.card.'+$(this).attr('id').replace(' ', '_');

                $(checkInput).hide("fast");
            }
        })
    })
</script>