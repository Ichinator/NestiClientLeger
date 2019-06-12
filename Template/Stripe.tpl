<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">

    console.log("Le script");
    try{
        // Création d'un client Stripe.
        var stripe = Stripe('pk_test_vx61qHe4VWW40GpoDpCTlHmz00CclJgFUQ');

        // Création d'une instance d'elements.
        var elements = stripe.elements();


        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Instanciation d'un card-element
        var card = elements.create('card', {style: style});

        // Ajoute l'instance du card element dans la <div> avec l'id 'card-element'.

        card.mount('#card-element');

        // Crée un listener pour une validation en temps réels des données des champs
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Event listener qui concerne la soumission du formulaire
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {

            console.log("Soumission du formulaire");
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                console.log("Création du token");
                if (result.error) {
                    console.log("Erreur dans la création du token");
                    // Informe l'utilisateur s'il y a une erreur
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log("Réussite de la création du token");
                    // Envoie du token au serveur
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Soumission du formulaire avec l'id du token
        function stripeTokenHandler(token) {
            // Insertion de l'id du token dans un champ caché pour qu'il soit envoyé au serveur
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            console.log("Voici le token : "+token);


            // Submit the form
            form.submit();
        }
    }catch (error){
        console.log("Erreur dans le script : "+error);
    }
</script>