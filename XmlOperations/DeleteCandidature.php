<?php
session_start();
$xmlFile = '../xml/BaseXml.xml';
$xml = simplexml_load_file($xmlFile);

    $candidat = $_SESSION['cin'];

    // Rechercher la candidature du candidat
    $candidature = $xml->xpath("//Candidatures/candidature[@Candidat='$candidat']")[0];

    // Supprimer la candidature du XML
    unset($candidature[0]);

    // Enregistrement des modifications dans le fichier XML
    $xml->asXML($xmlFile);

    echo "Candidature supprimée avec succès.";
    $messageSuccess = 'Candidature supprimée avec succès.';
    header('Location: ../candidature/candidatureInfos?messageSuccess=' . urlencode($messageSuccess));
?>