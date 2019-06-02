
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script>

    if(localStorage.getItem("id") && window.location.href.indexOf("/connect") > -1){
        alert("Vous êtes connecté, pas la peine de revenir");
        window.location = "http://localhost:8000/";
        alert(window.location.toString());
    }
</script>