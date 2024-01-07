<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $newExperience = isset($_POST["expDetail"]) ? $_POST["expDetail"] : null;
    $newExperienceYears = isset($_POST["expYears"]) ? $_POST["expYears"] : null;

    // Vérifier si l'une des variables n'est pas vide avant de procéder à la modification
    if (!empty($newExperience) || !empty($newExperienceYears)) {
        // Chemin vers le fichier XML
        $xmlFile = '../xml/BaseXml.xml';

        // Charger le fichier XML
        $xml = new DOMDocument();
        $xml->load($xmlFile);

        // Créer un objet DOMXPath
        $xpath = new DOMXPath($xml);

        // Récupérer le nœud <experienceProfisonnelle> du candidat correspondant à la session en cours
        $sessionCIN = $_SESSION['cin'];
        $experienceProfNode = $xpath->query("//candidat[@Utilisateur='$sessionCIN']/experienceProfisonnelle")->item(0);

        if ($experienceProfNode !== null) {
            // Mettre à jour les informations de l'expérience si au moins un champ est renseigné
            if (!empty($newExperience)) {
                $experienceProfNode->getElementsByTagName('experiencePro')->item(0)->nodeValue = $newExperience;
            }
            if (!empty($newExperienceYears)) {
                $experienceProfNode->getElementsByTagName('nombreAnne')->item(0)->nodeValue = $newExperienceYears;
            }

            // Enregistrer les modifications dans le fichier XML
            $xml->save($xmlFile);
            $successMessage = "Les informations ont été mises à jour avec succès !";
            header("Location: ../candidature/ExperiencePro.php?messageSuccess=" . urlencode($successMessage));
            exit();
        }
    } else {
        // Gérer le cas où aucun champ n'est renseigné
        $errorMessage = "Veuillez remplir au moins un champ.";
        header("Location: ../candidature/ExperiencePro.php?messageError=" . urlencode($errorMessage));
        exit();
    }
}
