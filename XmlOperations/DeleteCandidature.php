<?php
session_start();
$xmlFile = '../xml/BaseXml.xml';
$xml = simplexml_load_file($xmlFile);

    $candidat = $_SESSION['cin'];

    $candidature = $xml->xpath("//Candidatures/candidature[@Candidat='$candidat']")[0];

    unset($candidature[0]);

    $xml->asXML($xmlFile);

    echo "Candidature supprimée avec succès.";
    $messageSuccess = 'Candidature supprimée avec succès.';
    header('Location: ../candidature/candidatureInfos?messageSuccess=' . urlencode($messageSuccess));
?>