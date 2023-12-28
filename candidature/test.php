<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturer les données du formulaire
    $nomComplet = 'Yarbi tsdaq';
    $fKUser = 'MD26234';
    $cne = $_POST['CNE'];
    $appoge = isset($_POST['appoge']) ? $_POST['appoge'] : '';
    $email = $_POST['email'];
    $adresse1 = $_POST['addresse1'];
    $adresse2 = isset($_POST['addresse2']) ? $_POST['addresse2'] : '';
    $dateNaissance = $_POST['dateNaissance'];
    $lieuNaissance = $_POST['lieuNaissance'];
    // Element bac
    $anneeBac = $_POST['anneeBac'];
    $noteBac = $_POST['noteBac'];
    $mentionBac = $_POST['mentionBac'];
    $typeBac = $_POST['typeBac'];
    $academieBac = $_POST['academieBac'];

    //element diplome
    $mentionDiplome = $_POST['mentionDiplome'];
    $TypeFormation = $_POST['TypeFormation'];
    $FiliereDiplome = $_POST['FiliereDiplome'];
    $etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : '';
    $centre = isset($_POST['centre']) ? $_POST['centre'] : '';
    $anneePremiereAnnee = $_POST['InofsPremiereAnnee-annee'];
    $nombreEtudiantsPremiereAnnee = $_POST['InofsPremiereAnnee-NombreEtudiant'];
    $moyennePremiereAnnee = $_POST['InofsPremiereAnnee-moyenne'];
    $classementPremiereAnnee = $_POST['InofsPremiereAnnee-classement'];
    $anneeDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-annee'];
    $nombreEtudiantsDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-NombreEtudiant'];
    $moyenneDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-moyenne'];
    $classementDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-classement'];

    //exprience prefossionelle

    // Validation des données (vous pouvez ajouter des vérifications supplémentaires ici)

    // Charger le fichier XML
    $xmlFile = '../xml/baseXml.xml';
    $xml = new DOMDocument();
    $xml->load($xmlFile);

    // Récupérer l'élément 'candidats'
    $candidats = $xml->getElementsByTagName('Candidats')->item(0);
    $documents = $xml->getElementsByTagName('documents')->item(0);

    // Créer un nouvel élément 'candidat'
    $candidat = $xml->createElement('candidat');
    $candidat->setAttribute('CNE', $cne);
    $candidat->setAttribute('appoge', $appoge);
    $candidat->setAttribute('Utilisateur', $fKUser);

    // Créer et ajouter des éléments pour le candidat
    $candidat->appendChild($xml->createElement('nomComplet', 'Yarbi tsdaq')); // Remplacez 'Nom Complet' par la valeur réelle
    $candidat->appendChild($xml->createElement('email', $email));
    $candidat->appendChild($xml->createElement('addresse1', $adresse1));
    $candidat->appendChild($xml->createElement('addresse2', $adresse2));
    $candidat->appendChild($xml->createElement('dateNaissance', $dateNaissance));
    $candidat->appendChild($xml->createElement('lieuNaissance', $lieuNaissance));

    //element bac

    $bac = $xml->createElement('bac');

    // Créer et ajouter des éléments pour le bac
    $bac->appendChild($xml->createElement('anneeBac', $anneeBac));
    $bac->appendChild($xml->createElement('noteBac', $noteBac));
    $bac->setAttribute('mentionBac', $mentionBac);
    $bac->setAttribute('type', $typeBac);
    $bac->setAttribute('accadime', $academieBac);
    $candidat->appendChild($bac);

    // Créer et ajouter des éléments pour le diplome
    $newDiplome = $xml->createElement('Diplome');

    $newDiplome->setAttribute('mentionDiplome', $mentionDiplome);
    $newDiplome->setAttribute('Etablissement', $etablissement);
    $newDiplome->setAttribute('typeFormation', $TypeFormation);
    $newDiplome->setAttribute('filiereDiplome', $FiliereDiplome);

    // Création des éléments <InofsPremiereAnnee> et <InofsDeuxiemeAnnee>
 

    // Ajout des attributs pour <InofsPremiereAnnee>
    // Création de l'élément <InofsPremiereAnnee>
    $premiereAnneeElement = $xml->createElement('InofsPremiereAnnee');
    $premiereAnneeElement->appendChild($xml->createElement('annee', $anneePremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('NombreEtudiant', $nombreEtudiantsPremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('moyenne', $moyennePremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('classement', $classementPremiereAnnee));

    // Ajout de l'élément <InofsPremiereAnnee> à un parent, par exemple $parentElement->appendChild($premiereAnneeElement);

    // Création de l'élément <InofsDeuxiemeAnnee>
    $deuxiemeAnneeElement = $xml->createElement('InofsDeuxiemeAnnee');
    $deuxiemeAnneeElement->appendChild($xml->createElement('annee', $anneeDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('NombreEtudiant', $nombreEtudiantsDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('moyenne', $moyenneDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('classement', $classementDeuxiemeAnnee));

    // Ajout de l'élément <InofsDeuxiemeAnnee> à un parent, par exemple $parentElement->appendChild($deuxiemeAnneeElement);

    // Ajout des éléments <InofsPremiereAnnee> et <InofsDeuxiemeAnnee> sous l'élément <Diplome>
    $newDiplome->appendChild($premiereAnneeElement);
    $newDiplome->appendChild($deuxiemeAnneeElement);

    $candidat->appendChild($newDiplome);

    $experienceProElement = $xml->createElement('experiencePro', $_POST['experiencePro']);
    $nombreAnneElement = $xml->createElement('nombreAnne', $_POST['nombreAnne']);

    // Ajoutez ces éléments à un nouvel élément experienceProfisonnelle
    $experienceProfElement = $xml->createElement('experienceProfisonnelle');
    $experienceProfElement->appendChild($experienceProElement);
    $experienceProfElement->appendChild($nombreAnneElement);

    // Ajoutez l'attribut idCandidat à l'élément experienceProfisonnelle
    $candidat->appendChild($experienceProfElement);

    // Dossier de destination pour les fichiers téléchargés
    $dossierDestination = 'imageCandidature/img';

    foreach ($_FILES as $inputName => $file) {
        // if ($file['error'] !== UPLOAD_ERR_OK) {
        //     // Gérer l'erreur du téléchargement du fichier si nécessaire
        //     continue;
        // }

        $nomFichier = uniqid() . '_' . basename($file['name']);
        $cheminFichier = $dossierDestination . $nomFichier;

        if (move_uploaded_file($file['tmp_name'], $cheminFichier)) {
            // Ici, vous devrez insérer le chemin $cheminFichier dans votre XML
            // Utilisez les informations sur le type de document correspondant à $inputName
            $idTypeDocument = $inputName;

            // Insérer dans le XML en utilisant DOMDocument ou SimpleXML
            // ...

            $document = $xml->createElement('Document');

            // Créer et ajouter des éléments pour le bac
            $document->appendChild($xml->createElement('file', $cheminFichier));
            $document->setAttribute('idTypeDocument', $idTypeDocument);
        }
        $candidat->appendChild($document);
    }

    $candidats->appendChild($candidat);
    $xml->save($xmlFile);

    // Gérer les erreurs et envoyer une réponse à l'utilisateur
    // Vous pouvez ajouter ici la logique pour la gestion des erreurs ou la confirmation d'insertion
}
?>
