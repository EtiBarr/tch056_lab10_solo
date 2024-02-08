document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById('login-button').addEventListener('click', function() {

        // Récupérer le contenu du champ de saisie
        const valeurUser = document.getElementById('username').value;
        const valeurPsw = document.getElementById('password').value;

        // Vérifier si le champ de saisie est vide
        if (valeurUser === '') {
            alert('Veuillez saisir un Username');
            return;
        }
        if (valeurPsw === '') {
            alert('Veuillez saisir un mot de passe');
            return;
        }

        // Création d'une nouvelle instance de XMLHttpRequest
        const requete = new XMLHttpRequest();

        // Configuration de la requête HTTP GET vers une URL
        requete.open('POST', 'http://localhost:1234/api/encryption.php/encrypter', true);

        // Définition de l'en-tête de la requête pour spécifier le type de contenu
        requete.setRequestHeader('Content-Type', 'application/json');

        // Définition des données JSON à envoyer dans la requête
        const requeteJSON = JSON.stringify({
            "valeurUser": valeurUser,
            "valeurPsw": valeurPsw
        });


        // Définition de la fonction à exécuter une fois la requête terminée
        requete.onreadystatechange = function () {

            // Afficher le résultat dans la page
            const elementResultat = document.getElementById('resultat');

            // Vérification si la requête est terminée (readyState === 4)
            // et si le statut de la réponse est 200 - OK
            if (requete.readyState === 4 && requete.status === 200) {

                // Traitement de la réponse reçue du serveur
                const response = JSON.parse(requete.responseText);

                // Afficher le résultat dans la page
                if (response['valeur_encryptee'] !== null) {
                    elementResultat.value = response['valeur_encryptee'];
                } else {
                    elementResultat.value = 'Erreur lors de l\'appel à l\'API';
                }
            }
        };

        // Envoi de la requête
        requete.send(requeteJSON);

    });

});
