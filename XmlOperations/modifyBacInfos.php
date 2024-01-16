<?php
session_start();    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anneeBac = $_POST["anneeBac"];
    $noteBac = $_POST["noteBac"];
    $academieBac = $_POST["academieBac"];
    $typeBac = $_POST["typeBac"];
    $mentionBac = $_POST["mentionBac"];

    $sessionCIN = $_SESSION["cin"];
    $xml = new DOMDocument();

    $xml->load('../xml/baseXml.xml');
    $xpath = new DOMXPath($xml);
    $candidats = $xpath->query("//candidat[@Utilisateur='$sessionCIN']");

    if ($candidats->length > 0) {
        $candidat = $candidats->item(0);
        $bac = $candidat->getElementsByTagName('bac')->item(0);
    }

    if (!empty($mentionBac)) {
        $bac->setAttribute('mentionBac', $mentionBac);
    }
    if (!empty($typeBac)) {
        $bac->setAttribute('type', $typeBac);
    }
    if (!empty($accadime)) {
        $bac->setAttribute('accadime', $accadime);
    }

    $anneeBacElement = $bac->getElementsByTagName('anneeBac')->item(0);
    if ($anneeBacElement !== null && !empty($anneeBac)) {
        $anneeBacElement->nodeValue = $anneeBac;
    }

    $noteBacElement = $bac->getElementsByTagName('noteBac')->item(0);
    if ($noteBacElement !== null && !empty($noteBac)) {
        $noteBacElement->nodeValue = $noteBac;
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
    
    updateFileInXml($candidat, 'bac', 'baccalaureat');
    
    $xml->save('../xml/baseXml.xml');
    $successMessage = "Les informations du Bac ont été mises à jour avec succès !";
    header("Location: ../candidature/bacInfos.php?messageSuccess=" . urlencode($successMessage));
    exit();
}
?>
