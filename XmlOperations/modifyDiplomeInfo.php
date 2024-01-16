<?php
session_start();    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mentionDiplome = $_POST["mentionDiplome"];
    $typeFormation = $_POST["TypeFormation"];
    $etablissement = $_POST["etablissement"];
    $filiereDiplome = $_POST["FiliereDiplome"];
    $anneePremiereAnnee = $_POST["InofsPremiereAnnee-annee"];
    $nombreEtudiantPremiereAnnee = $_POST["InofsPremiereAnnee-NombreEtudiant"];
    $moyennePremiereAnnee = $_POST["InofsPremiereAnnee-moyenne"];
    $classementPremiereAnnee = $_POST["InofsPremiereAnnee-classement"];
    $anneeDeuxiemeAnnee = $_POST["InofsDouxiemeAnnee-annee"];
    $nombreEtudiantDeuxiemeAnnee = $_POST["InofsDouxiemeAnnee-NombreEtudiant"];
    $moyenneDeuxiemeAnnee = $_POST["InofsDouxiemeAnnee-moyenne"];
    $classementDeuxiemeAnnee = $_POST["InofsDouxiemeAnnee-classement"];

    $sessionCIN = $_SESSION["cin"];
    $xml = new DOMDocument();

    $xml->load('../xml/baseXml.xml');
    $xpath = new DOMXPath($xml);
    $candidats = $xpath->query("//candidat[@Utilisateur='$sessionCIN']");

    if ($candidats->length > 0) {
        $candidat = $candidats->item(0);
        $diplome = $candidat->getElementsByTagName('Diplome')->item(0);
    }
    if (!empty($mentionDiplome)) {
        $diplome->setAttribute('mentionDiplome', $mentionDiplome);
    }
    if (!empty($typeFormation)) {
        $diplome->setAttribute('typeFormation', $typeFormation);
    }
    if (!empty($filiereDiplome)) {
        $diplome->setAttribute('filiereDiplome', $filiereDiplome);
    }
    if (!empty($etablissement)) {
        $diplome->setAttribute('Etablissement', $etablissement);
    }
    if (!empty($_POST['centre'])) {
        $diplome->setAttribute('Etablissement', $_POST['centre']);
    }

    $premiereAnnee = $diplome->getElementsByTagName('InofsPremiereAnnee')->item(0);
    $deuxiemeAnnee = $diplome->getElementsByTagName('InofsDeuxiemeAnnee')->item(0);

    if (!empty($anneePremiereAnnee)) {
        $premiereAnnee->getElementsByTagName('annee')->item(0)->nodeValue = $anneePremiereAnnee;
    }
    if (!empty($nombreEtudiantPremiereAnnee)) {
        $premiereAnnee->getElementsByTagName('NombreEtudiant')->item(0)->nodeValue = $nombreEtudiantPremiereAnnee;
    }
    if (!empty($moyennePremiereAnnee)) {
        $premiereAnnee->getElementsByTagName('moyenne')->item(0)->nodeValue = $moyennePremiereAnnee;
    }
    if (!empty($classementPremiereAnnee)) {
        $premiereAnnee->getElementsByTagName('classement')->item(0)->nodeValue = $classementPremiereAnnee;
    }
    if (!empty($anneeDeuxiemeAnnee)) {
        $deuxiemeAnnee->getElementsByTagName('annee')->item(0)->nodeValue = $anneeDeuxiemeAnnee;
    }
    if (!empty($nombreEtudiantDeuxiemeAnnee)) {
        $deuxiemeAnnee->getElementsByTagName('NombreEtudiant')->item(0)->nodeValue = $nombreEtudiantDeuxiemeAnnee;
    }
    if (!empty($moyenneDeuxiemeAnnee)) {
        $deuxiemeAnnee->getElementsByTagName('moyenne')->item(0)->nodeValue = $moyenneDeuxiemeAnnee;
    }
    if (!empty($classementDeuxiemeAnnee)) {
        $deuxiemeAnnee->getElementsByTagName('classement')->item(0)->nodeValue = $classementDeuxiemeAnnee;
    }

    function updateFileInXml($candidat, $fileType, $xmlId) {
        if ($_FILES[$fileType]['size'] > 0) {
            $dossierDestination = '../assets/imageCandidature/';
            $nomFichier = uniqid() . '_' . basename($_FILES[$fileType]['name']);
            $cheminFichier = $dossierDestination . $nomFichier;
    
            if (move_uploaded_file($_FILES[$fileType]['tmp_name'], $cheminFichier)) {
                $fileNodes = $candidat->getElementsByTagName('Document');
                foreach ($fileNodes as $node) {
                    if ($node->getAttribute('idTypeDocument') === $xmlId) {
                        $node->getElementsByTagName('file')->item(0)->nodeValue = $cheminFichier;
                        break;
                    }
                }
            }
        }
    }
    
    updateFileInXml($candidat, 'bac', 'diplomeBac2');
    updateFileInXml($candidat, 'rnpa', 'releveeDeNotes1');
    updateFileInXml($candidat, 'rnda', 'releveeDeNotes2');
    
    $xml->save('../xml/baseXml.xml');
    $successMessage = "Les informations ont été mises à jour avec succès !";
    header("Location: ../candidature/diplomeInfos.php?messageSuccess=" . urlencode($successMessage));
    exit();
}
?>
