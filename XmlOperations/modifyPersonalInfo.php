<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xmlFile = '../xml/BaseXml.xml'; // Mettez ici le chemin de votre fichier XML

    $xml = new DOMDocument();
    $xml->load($xmlFile);

    $xpath = new DOMXPath($xml);
    $candidat = $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']")->item(0);

    // Mettre à jour les informations avec les données du formulaire
    $candidat->getElementsByTagName('nomComplet')->item(0)->nodeValue = $_POST['nomComplet'];
    $candidat->getElementsByTagName('email')->item(0)->nodeValue = $_POST['email'];
    $candidat->getElementsByTagName('addresse1')->item(0)->nodeValue = $_POST['adresse1'];
    $candidat->getElementsByTagName('addresse2')->item(0)->nodeValue = $_POST['adresse2'];
    $candidat->getElementsByTagName('dateNaissance')->item(0)->nodeValue = $_POST['dateNaissance'];
    $candidat->getElementsByTagName('lieuNaissance')->item(0)->nodeValue = $_POST['lieuNaissance'];

    // Gestion de la photo de profil
    if ($_FILES['photoProfil']['size'] > 0) {
        $dossierDestination = '../assets/imageCandidature/';
        $nomFichier = uniqid() . '_' . basename($_FILES['photoProfil']['name']);
        $cheminFichier = $dossierDestination . $nomFichier;
    
        if (move_uploaded_file($_FILES['photoProfil']['tmp_name'], $cheminFichier)) {
            // Trouver l'élément de la photo de profil existante dans le XML et le remplacer
            $photoProfilNodes = $candidat->getElementsByTagName('Document');
            foreach ($photoProfilNodes as $node) {
                if ($node->getAttribute('idTypeDocument') === 'photoProfil') {
                    $node->getElementsByTagName('file')->item(0)->nodeValue = $cheminFichier;
                    break; // Sortir de la boucle une fois la photo de profil remplacée
                }
            }
        }
    }
    

    // Enregistrer les modifications dans le fichier XML
    $xml->save($xmlFile);

    // Rediriger avec un message de succès
    $successMessage = "Les informations ont été mises à jour avec succès !";
    header("Location: ../candidature/personalInfos.php?messageSuccess=" . urlencode($successMessage));
    exit();
}
?>
