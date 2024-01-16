<?php
session_start();
$xmlFile = '../xml/BaseXml.xml';
$xml = simplexml_load_file($xmlFile);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidat = $_SESSION['cin'];
    $nouveauChoixFiliere1 = $_POST['choixFiliere1'];
    $nouveauChoixFiliere2 = $_POST['choixFiliere2'];
    $nouveauChoixFiliere3 = $_POST['choixFiliere3'];

    $candidature = $xml->xpath("//Candidatures/candidature[@Candidat='$candidat']")[0];

    if (!empty($nouveauChoixFiliere1)) {
        $choix1 = $candidature->choix[0];
        $choix1['idFiliereSouhaite'] = $nouveauChoixFiliere1;
    }

    if (!empty($nouveauChoixFiliere2)) {
        $choix2 = $candidature->choix[1];
        $choix2['idFiliereSouhaite'] = $nouveauChoixFiliere2;
    }

    if (!empty($nouveauChoixFiliere3)) {
        $choix3 = $candidature->choix[2];
        $choix3['idFiliereSouhaite'] = $nouveauChoixFiliere3;
    }

    $xml->asXML($xmlFile);
    
    $messageSuccess = 'Les informations ont été mises à jour avec succès !';
    header('Location: ../candidature/candidatureInfos?messageSuccess=' . urlencode($messageSuccess));
    exit(); 
}
?>
