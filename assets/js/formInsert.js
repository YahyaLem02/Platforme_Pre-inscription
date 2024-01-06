   /**
         * Define a function to navigate betweens form steps.
         * It accepts one parameter. That is - step number.
         */
   const navigateToFormStep = (stepNumber) => {
    /**
     * Hide all form steps.
     */
    document.querySelectorAll(".form-step").forEach((formStepElement) => {
        formStepElement.classList.add("d-none");
    });
    /**
     * Mark all form steps as unfinished.
     */
    document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
        formStepHeader.classList.add("form-stepper-unfinished");
        formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
    });
    /**
     * Show the current form step (as passed to the function).
     */
    document.querySelector("#step-" + stepNumber).classList.remove("d-none");
    /**
     * Select the form step circle (progress bar).
     */
    const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
    /**
     * Mark the current form step as active.
     */
    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
    formStepCircle.classList.add("form-stepper-active");
    /**
     * Loop through each form step circles.
     * This loop will continue up to the current step number.
     * Example: If the current step is 3,
     * then the loop will perform operations for step 1 and 2.
     */
    for (let index = 0; index < stepNumber; index++) {
        /**
         * Select the form step circle (progress bar).
         */
        const formStepCircle = document.querySelector('li[step="' + index + '"]');
        /**
         * Check if the element exist. If yes, then proceed.
         */
        if (formStepCircle) {
            /**
             * Mark the form step as completed.
             */
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
            formStepCircle.classList.add("form-stepper-completed");
        }
    }
};
/**
 * Select all form navigation buttons, and loop through them.
 */
document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
    /**
     * Add a click event listener to the button.
     */
    formNavigationBtn.addEventListener("click", () => {
        /**
         * Get the value of the step.
         */
        const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
        /**
         * Call the function to navigate to the target form step.
         */
        navigateToFormStep(stepNumber);
    });
});


// JavaScript pour ajouter dynamiquement des champs pour le baccalauréat

function showFields() {
    var typeFormation = document.getElementById("TypeFormation");
    var selectedValue = typeFormation.options[typeFormation.selectedIndex].value;

    var formation1to3Div = document.querySelector('.formation1-3');
    var formation4to5Div = document.querySelector('.formation4-5');

    if (selectedValue === "formation1" || selectedValue === "formation2" || selectedValue === "formation3") {
        formation1to3Div.style.display = 'block';
        formation4to5Div.style.display = 'none';
    } else if (selectedValue === "formation4" || selectedValue === "formation5") {
        formation1to3Div.style.display = 'none';
        formation4to5Div.style.display = 'block';
    } else {
        formation1to3Div.style.display = 'none';
        formation4to5Div.style.display = 'none';
    }
}

// Fonction pour charger et traiter le fichier XML
function loadXMLDoc(filename) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", filename, false);
    xhttp.send();
    return xhttp.responseXML;
}

// Afficher les établissements en fonction de l'université sélectionnée
function showEtablissements() {
    var universiteSelect = document.getElementById("universite");
    var typeEtablissementSelect = document.getElementById("typeEtablissement");
    var etablissementSelect = document.getElementById("etablissement");

    var selectedUniversite = universiteSelect.options[universiteSelect.selectedIndex].value;
    var selectedTypeEtablissement = typeEtablissementSelect.options[typeEtablissementSelect.selectedIndex].value;

    // Charger le fichier XML
    var xmlDoc = loadXMLDoc("../xml/baseXml.xml");

    // Récupérer tous les établissements
    var etablissements = xmlDoc.getElementsByTagName("Etablissement");

    // Effacer les options actuelles
    etablissementSelect.innerHTML = '';

    // Parcourir les établissements et afficher ceux correspondant à l'université et au type d'établissement sélectionnés
    for (var i = 0; i < etablissements.length; i++) {
        var universite = etablissements[i].getAttribute("Universite");
        var typeEtablissement = etablissements[i].getAttribute("TypeEtablissement");

        if (universite === selectedUniversite && typeEtablissement === selectedTypeEtablissement) {
            var nomEtablissement = etablissements[i].getElementsByTagName("nomEtablissement")[0].childNodes[0]
                .nodeValue;
            var idEtablissement = etablissements[i].getAttribute("idEtablissement");
            var option = document.createElement("option");
            option.text = nomEtablissement;
            option.value = idEtablissement;
            etablissementSelect.add(option);
        }
    }
}

// Remplir les options de sélection initiales lors du chargement de la page
window.onload = function() {
    showEtablissements
        (); // Pour remplir les établissements initialement en fonction de l'université et du type d'établissement
};

function showCentres() {
    var villeSelect = document.getElementById("ville");
    var typeCentreSelect = document.getElementById("typeCentre");
    var centreSelect = document.getElementById("centre");

    var selectedVille = villeSelect.options[villeSelect.selectedIndex].value;
    var selectedTypeCentre = typeCentreSelect.options[typeCentreSelect.selectedIndex].value;

    // Charger le fichier XML
    var xmlDoc = loadXMLDoc("../xml/baseXml.xml");

    // Récupérer toutes les villes, types de centre et centres
    var villes = xmlDoc.getElementsByTagName("Ville");
    var typesCentre = xmlDoc.getElementsByTagName("TypeCentre");
    var centres = xmlDoc.getElementsByTagName("centre");

    // Effacer les options actuelles
    centreSelect.innerHTML = '';

    // Afficher les centres correspondant à la ville et au type de centre sélectionnés
    for (var i = 0; i < centres.length; i++) {
        var ville = centres[i].getAttribute("idVille");
        var typeCentre = centres[i].getAttribute("idTypeCentre");

        if (ville === selectedVille && typeCentre === selectedTypeCentre) {
            var nomCentre = centres[i].getElementsByTagName("NomCentre")[0].childNodes[0].nodeValue;
            var idCentre = centres[i].getAttribute("idCentre");

            var option = document.createElement("option");
            option.text = nomCentre;
            option.value = idCentre;
            centreSelect.appendChild(option);
        }
    }
}

// Remplir les options de sélection initiales lors du chargement de la page
window.onload = function() {
    showCentres(); // Pour remplir les centres initialement en fonction de la ville et du type de centre
};


function showVilles() {
    var regionSelect = document.getElementById("regions");
    var villeSelect = document.getElementById("villes");

    var selectedRegion = regionSelect.options[regionSelect.selectedIndex].value;

    // Charger le fichier XML
    var xmlDoc = loadXMLDoc("../xml/BaseXml.xml");

    // Récupérer toutes les villes
    var villes = xmlDoc.getElementsByTagName("Ville");

    // Effacer les options actuelles
    villeSelect.innerHTML = '';

    // Parcourir les villes et afficher celles correspondant à la région sélectionnée
    for (var i = 0; i < villes.length; i++) {
        var region = villes[i].getAttribute("region");

        if (region === selectedRegion) {
            var nomVille = villes[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
            var idVille = villes[i].getAttribute("idVille");

            var option = document.createElement("option");
            option.text = nomVille;
            option.value = idVille;
            villeSelect.add(option);
        }
    }
}

// Remplir les options de sélection initiales lors du chargement de la page
window.onload = function() {
    showVilles(); // Pour remplir les villes initialement en fonction de la région sélectionnée
};



const emailField = document.getElementById('email');
const confirmEmailField = document.getElementById('confirmEmail');

emailField.addEventListener('input', validateEmails);
confirmEmailField.addEventListener('input', validateEmails);

confirmEmailField.addEventListener('blur', function() {
    if (emailField.value !== confirmEmailField.value) {
        confirmEmailField.style.borderColor = 'red';
        alert('Les adresses email ne correspondent pas. Veuillez les saisir à nouveau.');
        confirmEmailField.value = ''; // Réinitialisation du champ Confirm Email
    } else {
        confirmEmailField.style.borderColor = 'green';
    }
});

function validateEmails() {
    const email = emailField.value;
    const confirmEmail = confirmEmailField.value;

    if (email !== confirmEmail) {
        emailField.style.borderColor = 'red';
        confirmEmailField.style.borderColor = 'red';
    } else {
        emailField.style.borderColor = 'green';
        confirmEmailField.style.borderColor = 'green';
    }
}