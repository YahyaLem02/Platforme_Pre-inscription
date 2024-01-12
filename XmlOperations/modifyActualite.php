<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dossierDestination = '../assets/imageCandidature/';
    if (isset($_POST['submit'])) {
        $cheminFichierXML = '../xml/BaseXml.xml';
        $xml = new DOMDocument();
        $xml->load($cheminFichierXML);
        $idActualiteAModifier = $_POST['idActualiteAModifier'];
        $xpath = new DOMXPath($xml);
        $query = "//Actualite[@idActualite='{$idActualiteAModifier}']";
        $actualiteAModifierNodes = $xpath->query($query);

        if ($actualiteAModifierNodes->length > 0) {
            $actualiteAModifier = $actualiteAModifierNodes->item(0);
            $actualiteAModifier->getElementsByTagName('Titre')->item(0)->textContent = $_POST['titre'];
            $actualiteAModifier->getElementsByTagName('Description')->item(0)->textContent = $_POST['description'];

            $imageFile = $_FILES['image'];

            if ($imageFile['error'] === UPLOAD_ERR_OK) {
                $nomFichierImage = uniqid() . '_' . basename($imageFile['name']);
                $cheminFichierImage = $dossierDestination . $nomFichierImage;

                if (move_uploaded_file($imageFile['tmp_name'], $cheminFichierImage)) {
                    $actualiteAModifier->getElementsByTagName('Image')->item(0)->textContent = $cheminFichierImage;
                } else {
                    echo 'Erreur lors du déplacement du fichier.';
                }
            } else {
                echo 'Erreur lors du téléchargement de l\'image.';
            }

            $xml->save($cheminFichierXML);
            $messageSuccess = 'Données modifiées avec succès.';
            header('Location: ../ChefDepartement/MesActualites.php?messageSuccess=' . urlencode($messageSuccess));
            exit();
        } else {
            echo 'Actualité non trouvée.';
            exit();
        }
    }
}
?>
