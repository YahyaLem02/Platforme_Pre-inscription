<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newExperience = isset($_POST["expDetail"]) ? $_POST["expDetail"] : null;
    $newExperienceYears = isset($_POST["expYears"]) ? $_POST["expYears"] : null;

    if (!empty($newExperience) || !empty($newExperienceYears)) {
        $xmlFile = '../xml/BaseXml.xml';

        $xml = new DOMDocument();
        $xml->load($xmlFile);

        $xpath = new DOMXPath($xml);

        $sessionCIN = $_SESSION['cin'];
        $experienceProfNode = $xpath->query("//candidat[@Utilisateur='$sessionCIN']/experienceProfisonnelle")->item(0);

        if ($experienceProfNode !== null) {
            if (!empty($newExperience)) {
                $experienceProfNode->getElementsByTagName('experiencePro')->item(0)->nodeValue = $newExperience;
            }
            if (!empty($newExperienceYears)) {
                $experienceProfNode->getElementsByTagName('nombreAnne')->item(0)->nodeValue = $newExperienceYears;
            }

            $xml->save($xmlFile);
            $successMessage = "Les informations ont été mises à jour avec succès !";
            header("Location: ../candidature/ExperiencePro.php?messageSuccess=" . urlencode($successMessage));
            exit();
        }
    } else {
        $errorMessage = "Veuillez remplir au moins un champ.";
        header("Location: ../candidature/ExperiencePro.php?messageError=" . urlencode($errorMessage));
        exit();
    }
}
