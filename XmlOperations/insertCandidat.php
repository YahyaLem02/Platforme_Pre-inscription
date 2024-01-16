<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

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
    $villeCandidat = $_POST['villeCandidat'];
    $academieBac = $_POST['academieBac'];

    //element diplome
    $mentionDiplome = $_POST['mentionDiplome'];
    $TypeFormation = $_POST['TypeFormation'];
    $FiliereDiplome = $_POST['FiliereDiplome'];

    $etablissement = $_POST['etablissement'];
    $centre = $_POST['centre'];

    $anneePremiereAnnee = $_POST['InofsPremiereAnnee-annee'];
    $nombreEtudiantsPremiereAnnee = $_POST['InofsPremiereAnnee-NombreEtudiant'];
    $moyennePremiereAnnee = $_POST['InofsPremiereAnnee-moyenne'];
    $classementPremiereAnnee = $_POST['InofsPremiereAnnee-classement'];
    $anneeDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-annee'];
    $nombreEtudiantsDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-NombreEtudiant'];
    $moyenneDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-moyenne'];
    $classementDeuxiemeAnnee = $_POST['InofsDouxiemeAnnee-classement'];

    $xmlFile = '../xml/baseXml.xml';
    $xml = new DOMDocument();
    $xml->load($xmlFile);

    // Récupérer l'élément 'candidats'
    $candidats = $xml->getElementsByTagName('Candidats')->item(0);

    // Récupérer l'élément 'document'
    $documents = $xml->getElementsByTagName('documents')->item(0);

    // Créer un nouvel élément 'candidat'
    $candidat = $xml->createElement('candidat');
    $candidat->setAttribute('CNE', $cne);
    $candidat->setAttribute('appoge', $appoge);
    $candidat->setAttribute('ville', $villeCandidat);
    $candidat->setAttribute('Utilisateur', $_SESSION['cin']);

    // Créer et ajouter des éléments pour le candidat
    $candidat->appendChild($xml->createElement('nomComplet', $_SESSION['name']));
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

    if (!empty($etablissement)) {
        $newDiplome->setAttribute('Etablissement', $etablissement);
    } else {
        $newDiplome->setAttribute('Etablissement', $centre);
    }

    $newDiplome->setAttribute('typeFormation', $TypeFormation);
    $newDiplome->setAttribute('filiereDiplome', $FiliereDiplome);

    // Création des éléments <InofsPremiereAnnee> et <InofsDeuxiemeAnnee>

    // Création de l'élément <InofsPremiereAnnee>
    $premiereAnneeElement = $xml->createElement('InofsPremiereAnnee');
    $premiereAnneeElement->appendChild($xml->createElement('annee', $anneePremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('NombreEtudiant', $nombreEtudiantsPremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('moyenne', $moyennePremiereAnnee));
    $premiereAnneeElement->appendChild($xml->createElement('classement', $classementPremiereAnnee));

    // Création de l'élément <InofsDeuxiemeAnnee>
    $deuxiemeAnneeElement = $xml->createElement('InofsDeuxiemeAnnee');
    $deuxiemeAnneeElement->appendChild($xml->createElement('annee', $anneeDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('NombreEtudiant', $nombreEtudiantsDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('moyenne', $moyenneDeuxiemeAnnee));
    $deuxiemeAnneeElement->appendChild($xml->createElement('classement', $classementDeuxiemeAnnee));

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
    $dossierDestination = '../assets/imageCandidature/';

    foreach ($_FILES as $inputName => $file) {
        $nomFichier = uniqid() . '_' . basename($file['name']);
        $cheminFichier = $dossierDestination . $nomFichier;

        if (move_uploaded_file($file['tmp_name'], $cheminFichier)) {
        
            $idTypeDocument = $inputName;

            $document = $xml->createElement('Document');

            $document->appendChild($xml->createElement('file', $cheminFichier));
            $document->setAttribute('idTypeDocument', $idTypeDocument);
        }
        $candidat->appendChild($document);
    }

    $candidats->appendChild($candidat);
    $xml->save($xmlFile);
    $_SESSION['AccesForm']= false;
    $messageSuccess = 'Données insérées avec succès.';
    header('Location: ../candidature/personalInfos?messageSuccess=' . urlencode($messageSuccess));

}
?>
