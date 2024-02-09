document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.getElementById('collapseBtn');
    var aside = document.querySelector('aside');
    var content = document.querySelector('content');

    toggleButton.addEventListener('click', function () {
        var isCollapsed = aside.classList.toggle('collapsed');
        content.classList.toggle('collapsed');

        toggleButton.innerText = isCollapsed ? '➕' : '➖';
    });
});



//color toggle function
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("themeToggle");

    const elementsToToggle = [
        document.querySelector("body"),
        document.querySelector("header"),
        document.querySelector("nav"),
        document.querySelector("content"),
        document.querySelector("footer"),
        document.querySelector("#themeToggle"),
        document.querySelector("#signinbtn"),
        document.querySelector("#signUpbtn"),
        document.querySelector("#headerTitle"),
        ...document.querySelectorAll('.btn')
    ];

    const aside = document.querySelector("aside");
    const collapseBtn = document.querySelector("#collapseBtn");

    // verifying that aside and collapseBtn are in the page so that  
    // the script doesn't break for pages without those elements
    if (aside != null && collapseBtn != null) {
        elementsToToggle.push(
            aside,
            collapseBtn
        );
    }

    const blackLogo = document.querySelector(".blackLogo");
    const whiteLogo = document.querySelector(".whiteLogo");

    // Retrieve theme from localStorage
    const savedTheme = localStorage.getItem("theme");

    function applyTheme(theme) {
        elementsToToggle.forEach(el => el.classList.toggle("light", theme === "light"));
        toggleImageSrc(blackLogo, theme === "light");
        toggleImageSrc(whiteLogo, theme !== "light");
        toggleButton.innerText = theme === "light" ? '☀️' : '🌑';
    }

    //local storage for theme
    if (savedTheme) {
        applyTheme(savedTheme);
    }

    toggleButton.addEventListener("click", function () {
        const isLightMode = document.body.classList.toggle("light");

        // Save theme to localStorage
        localStorage.setItem("theme", isLightMode ? "light" : "dark");

        applyTheme(isLightMode ? "light" : "dark");
    });

    function toggleImageSrc(imageElement, isLightMode) {
        const newSrc = isLightMode ? "/images/plain_logo_white.png" : "/images/plain_logo.png";
        imageElement.setAttribute("src", newSrc);
    }
});





//contact form count display
function updateCharCount(textarea) {
    var maxLength = 250;
    var currentLength = textarea.value.length;
    var remainingLength = maxLength - currentLength;

    var charCountElement = document.getElementById('charCount');
    charCountElement.textContent = 'Characters remaining: ' + remainingLength;
}



//validation of password when registering
document.addEventListener("DOMContentLoaded", function() {

    // Add event listener to the form submission
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        
        var password = document.getElementById("reg-password").value;

        // Define regular expressions for each password criteria
        var hasLowerCase = /[a-z]/.test(password);
        var hasUpperCase = /[A-Z]/.test(password);
        var hasDigit = /\d/.test(password);
        var hasSymbol = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);

        // Check if all criteria are met
        if(password != document.getElementById("confirm-password").value) {
            alert("Both passwords have to be the same!");
            event.preventDefault(); // Prevent form submission if validation fails
        }else if (password.length >= 8 && hasLowerCase && hasUpperCase && hasDigit && hasSymbol) {
            //where we will create the login
            return true;
        } else {
            event.preventDefault(); // Prevent form submission if validation fails
            alert("Password must have at least 8 characters, including one lowercase letter, one uppercase letter, one digit, and one symbol.");
            return false;
        }

    });
});

//end of registration password validation 



//validation login

document.addEventListener("DOMContentLoaded", function() {
    
    document.getElementById('login-button').addEventListener('click', function() {

        // Récupérer le contenu du champ de saisie
        const valeurUser = document.getElementById('username').value;
        const valeurPsw = document.getElementById('password').value;

        // Vérifier si le champ de saisie est vide
        if (valeurUser === '' || valeurPsw === '') {
            alert('Veuillez saisir un Username et un mot de passe');
            return;
        }
    
        // Création d'une nouvelle instance de XMLHttpRequest
        const requete = new XMLHttpRequest();

        // Configuration de la requête post vers index.php
        requete.open('POST', '/scripts/index.php', true);

        // Définition de l'en-tête de la requête pour spécifier le type de contenu
        requete.setRequestHeader('Content-Type', 'application/json');

        // Définition des données JSON à envoyer dans la requête
        const requeteJSON = JSON.stringify({
            "valeurUser": valeurUser,
            "valeurPsw": valeurPsw
        });

        // Définition de la fonction à exécuter une fois la requête terminée
        requete.onreadystatechange = function () {

        // Vérification si la requête est terminée (readyState === 4)
        // et si le statut de la réponse est 200 - OK
        if (requete.readyState === 4 && requete.status === 200) {

            // Traitement de la réponse reçue du serveur
            const valeur = JSON.parse(requete.responseText);  

            // Afficher le résultat dans la page
            if (valeur['success'] !== null) {
                elementResultat.value = 'success';
            } else {
                elementResultat.value = 'verification n\'est pas valide';
            }

        }

    };

    // Envoi de la requête
    requete.send(requeteJSON);

});

});







/*



document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('login-button').addEventListener('click', function (event) {
        const valeurUser = document.getElementById('username').value;
        const valeurPsw = document.getElementById('password').value;

        if (valeurUser === '' || valeurPsw === '') {
            alert('Veuillez saisir un Username et un mot de passe');
            return;
        }

        const requete = new XMLHttpRequest();
        requete.open('POST', 'login.php', true);
        requete.setRequestHeader('Content-Type', 'application/json');

        const jsonData = JSON.stringify({
            valeurUser: valeurUser,
            valeurPsw: valeurPsw
        });

        requete.onreadystatechange = function () {
            if (requete.readyState === 4) {
                if (requete.status === 200) {
                    const response = JSON.parse(requete.responseText);

                    const elementResultat = document.getElementById('resultat');
                    if (response['success']) {
                        // Redirect to the next page if login is successful
                        window.location.href = 'next_page.html';
                    } else {
                        elementResultat.value = 'Erreur lors de l\'authentification';
                        
                        // Prevent form submission when login fails
                        event.preventDefault();
                    }
                } else {
                    console.error('Erreur de la requête: ' + requete.status);
                }
            }
        };

        requete.send(jsonData);
    });
});
*/