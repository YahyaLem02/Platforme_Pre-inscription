<?php
session_start();
$xmlFile = '../xml/BaseXml.xml';
$xml = simplexml_load_file($xmlFile);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choixFiliere1 = $_POST['choixFiliere1'];
    $choixFiliere2 = $_POST['choixFiliere2'];
    $choixFiliere3 = $_POST['choixFiliere3'];

    $candidatures = $xml->xpath("//Candidatures")[0];
    $candidature = $candidatures->addChild('candidature');
    $candidature->addAttribute('Candidat', $_SESSION['cin']); // Année actuelle


    $candidature->addChild('status', 'En cours de traitement');
    $candidature->addChild('AnnneCandidature', (date("Y") - 1) . '-' . date("Y")); 

    // Ajouter les éléments 'choix' dans 'candidature'
    $choix1 = $candidature->addChild('choix');
    $choix1->addAttribute('idFiliereSouhaite', $choixFiliere1);
    $choix1->addChild('ordre', 1);

    $choix2 = $candidature->addChild('choix');
    $choix2->addAttribute('idFiliereSouhaite', $choixFiliere2);
    $choix2->addChild('ordre', 2);

    $choix3 = $candidature->addChild('choix');
    $choix3->addAttribute('idFiliereSouhaite', $choixFiliere3);
    $choix3->addChild('ordre', 3);

    // Attribut 'Candidat' est requis dans le schéma, veuillez l'ajouter avec la valeur appropriée

    // Enregistrement des modifications dans le fichier XML
    $xml->asXML($xmlFile);

    echo "Données insérées avec succès dans le fichier XML.";
} else {
    echo "Formulaire non soumis.";
}
?>