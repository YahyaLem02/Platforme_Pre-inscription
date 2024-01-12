<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inclure le chemin de destination
    $dossierDestination = '../assets/imageCandidature/';

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Charger le fichier XML existant
        $cheminFichierXML = '../xml/BaseXml.xml';
        $xml = new DOMDocument();
        $xml->load($cheminFichierXML);

        // Créer un nouvel élément Actualite
        $actualite = $xml->createElement('Actualite');

        // Générer une valeur pour idActualite (2 lettres majuscules + 3 chiffres)
        $idActualite = generateIdActualite();
        $actualite->setAttribute('idActualite', $idActualite);

        // Récupérer la valeur de idChef depuis la session
        $idChef = $_SESSION['cin'];
        $actualite->setAttribute('idChef', $idChef);

        // Ajouter les éléments Titre, Description et Image
        $titre = $xml->createElement('Titre', $_POST['titre']);
        $description = $xml->createElement('Description', $_POST['description']);

        // Traiter l'image
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

        // Ajouter les éléments à l'ordre spécifié (Titre, Description, Image)

        // Trouver l'élément Actualites dans le document
        $actualitesElement = $xml->getElementsByTagName('Actualites')->item(0);

        // Ajouter l'élément Actualite à Actualites
        $actualitesElement->appendChild($actualite);

        // Sauvegarder les modifications dans le fichier XML
        $xml->save($cheminFichierXML);

        // Redirection ou autre traitement après l'insertion
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
