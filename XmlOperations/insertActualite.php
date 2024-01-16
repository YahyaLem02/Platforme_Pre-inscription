<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dossierDestination = '../assets/imageCandidature/';

    if (isset($_POST['submit'])) {
        $cheminFichierXML = '../xml/BaseXml.xml';
        $xml = new DOMDocument();
        $xml->load($cheminFichierXML);

        $actualite = $xml->createElement('Actualite');

        $idActualite = generateIdActualite();
        $actualite->setAttribute('idActualite', $idActualite);

        $idChef = $_SESSION['cin'];
        $actualite->setAttribute('idChef', $idChef);

        $titre = $xml->createElement('Titre', $_POST['titre']);
        $description = $xml->createElement('Description', $_POST['description']);

        $actualite->appendChild($titre);
        $actualite->appendChild($description);

        $imageFile = $_FILES['image'];

        if ($imageFile['error'] === UPLOAD_ERR_OK) {
            $nomFichierImage = uniqid() . '_' . basename($imageFile['name']);
            $cheminFichierImage = $dossierDestination . $nomFichierImage;

            if (move_uploaded_file($imageFile['tmp_name'], $cheminFichierImage)) {
                $elementImage = $xml->createElement('Image', $cheminFichierImage);
                $actualite->appendChild($elementImage);
            } else {
                echo 'Erreur lors du déplacement du fichier.';
            }
        } else {
            echo 'Erreur lors du téléchargement de l\'image.';
        }

        $actualitesElement = $xml->getElementsByTagName('Actualites')->item(0);

        $actualitesElement->appendChild($actualite);

        $xml->save($cheminFichierXML);

        $messageSuccess = 'Données insérées avec succès.';
        header('Location: ../ChefDepartement/MesActualites.php?messageSuccess=' . urlencode($messageSuccess));
        exit();
    }
}

function generateIdActualite()
{
    $letters = range('A', 'Z');
    $randomLetters = $letters[array_rand($letters)] . $letters[array_rand($letters)];
    $randomNumbers = sprintf('%03d', mt_rand(0, 999));
    return $randomLetters . $randomNumbers;
}
?>
