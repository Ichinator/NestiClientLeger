
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script>

    if(localStorage.getItem("id") && window.location.href.indexOf("/connect") > -1){
        alert("Vous êtes connecté, pas la peine de revenir");
        window.location = "http://localhost:8000/";
    }


    var dynamicNavbar;

    console.log(localStorage.getItem("id"));
    console.log(localStorage.getItem("prenom"));

    if(localStorage.getItem("id") === null){
        dynamicNavbar ="<li class=\"nav-item dropdown\">\n" +
            "                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
            "                    Connexion / Enregistrement\n" +
            "                </a>\n" +
            "                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\n" +
            "                    <a class=\"dropdown-item\" href=\"/connect\">Connexion</a>\n" +
            "                    <a class=\"dropdown-item\" href=\"/register\">Enregistrement</a>\n" +
            "                </div>\n" +
            "            </li>";
        $(dynamicNavbar).insertBefore("#about");
    }else{
        dynamicNavbar = "<li class=\"nav-item dropdown\">\n" +
            "                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
            "                    Mon compte\n" +
            "                </a>\n" +
            "                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">\n" +
            "                    <a class=\"dropdown-item\" href=\"/personnalPage\">"+localStorage.getItem("prenom")+"</a>\n" +
            "                    <a class=\"dropdown-item\" href=\"/disconnect\" id=\"disconnectLink\">Se déconnecter</a>\n" +
            "                </div>\n" +
            "            </li>";
        $(dynamicNavbar).insertBefore("#about");
    }

    /*
    if(window.location.href.indexOf("/disconnect") > -1){
        localStorage.clear();
        window.location = "http://localhost:8000/";
    }*/

    //Permet de se déconnecter
    $("#disconnectLink").click(function () {
        localStorage.clear();
        window.location = "http://localhost:8000/";
    });
</script>