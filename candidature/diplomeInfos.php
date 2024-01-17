<?php
include '../Translation/headerTranslationCandidatConnect.php';
include '../XmlOperations/Permissions.php';
canAccessPage($isCandidat);
redirectIfNotAuthorized($VoirInfosPersonnelles);
?>
<!DOCTYPE html>
<html <?php echo $_SESSION['lang'] === 'arabic' ? 'lang="ar" dir="rtl"' : 'lang="fr" dir="ltr"'; ?>>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>E-candidature</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/DiplomeInfos.css" rel="stylesheet">

</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <?php
    $xmlFile = '../xml/BaseXml.xml'; 
    
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    $xpath = new DOMXPath($xml);

    $cin = $_SESSION['cin'];
    
    $candidat = $xpath->query("//candidat[@Utilisateur='$cin']")->item(0);
    
    if ($candidat !== null) {
        $diplome = $xpath->query('Diplome', $candidat)->item(0);
        $etablissement = $diplome->getAttribute('Etablissement');
        $typeFormation = $diplome->getAttribute('typeFormation');
        $filiereDiplome = $diplome->getAttribute('filiereDiplome');
    
        if ($diplome !== null) {
            $mentionDiplome = $diplome->getAttribute('mentionDiplome');
    
            $etablissements = $xpath->query("//Etablissement[@idEtablissement='$etablissement']/nomEtablissement");
            if ($etablissements->length == 0) {
                $etablissements = $xpath->query("//centre[@idCentre='$etablissement']/NomCentre");
            }
            if ($etablissements->length > 0) {
                $nomEtablissement = $etablissements->item(0)->nodeValue;
            } else {
                $nomEtablissement = 'Établissement non trouvé';
            }
    
            $typesFormations = $xpath->query("//TypeFormation[@idFormation='$typeFormation']/NomFormation");
            if ($typesFormations->length > 0) {
                $nomFormation = $typesFormations->item(0)->nodeValue;
            } else {
                $nomFormation = 'Type de formation non trouvé';
            }
    
            $filieresDiplome = $xpath->query("//FiliereDiplome[@idFiliere='$filiereDiplome']/intitule");
            if ($filieresDiplome->length > 0) {
                $intituleFiliere = $filieresDiplome->item(0)->nodeValue;
            } else {
                $intituleFiliere = 'Filière de diplôme non trouvée';
            }
    
            $infosPremiereAnnee = $xpath->query('InofsPremiereAnnee', $diplome)->item(0);
            $anneePremiereAnnee = $xpath->query('annee', $infosPremiereAnnee)->item(0)->nodeValue;
            $nombreEtudiantPremiereAnnee = $xpath->query('NombreEtudiant', $infosPremiereAnnee)->item(0)->nodeValue;
            $moyennePremiereAnnee = $xpath->query('moyenne', $infosPremiereAnnee)->item(0)->nodeValue;
            $classementPremiereAnnee = $xpath->query('classement', $infosPremiereAnnee)->item(0)->nodeValue;
    
            $infosDeuxiemeAnnee = $xpath->query('InofsDeuxiemeAnnee', $diplome)->item(0);
            $anneeDeuxiemeAnnee = $xpath->query('annee', $infosDeuxiemeAnnee)->item(0)->nodeValue;
            $nombreEtudiantDeuxiemeAnnee = $xpath->query('NombreEtudiant', $infosDeuxiemeAnnee)->item(0)->nodeValue;
            $moyenneDeuxiemeAnnee = $xpath->query('moyenne', $infosDeuxiemeAnnee)->item(0)->nodeValue;
            $classementDeuxiemeAnnee = $xpath->query('classement', $infosDeuxiemeAnnee)->item(0)->nodeValue;
    
        } else {
        }
    } else {
    }
    
    
    ?>

    <div class="bg-light">
        <div class="container">
            <div class="row">
                <!-- Section des Informations Générales du Diplôme -->
                <div class="col-lg-4 mb-4 mb-sm-5" id="cadre">
                    <div>
                        <div class="card border-0 ">
                            <div class="card-body">
                                <a href="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='diplomeBac2']/file")->item(0)->nodeValue; ?>" target="_blank">
                                    <img src="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='diplomeBac2']/file")->item(0)->nodeValue; ?>" alt="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='photoProfil']/file")->item(0)->nodeValue; ?>" id="fixed-size-image">
                                </a>
                                <h2 class="h3 mb-4"data-translate="diplomePage.Informations Générales du Diplôme"></h2>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                            class="display-26 text-secondary me-2 font-weight-600"data-translate="diplomePage.Mention"></span>
                                        <?php echo $mentionDiplome; ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                            class="display-26 text-secondary me-2 font-weight-600"data-translate="diplomePage.Établissement"></span>
                                        <?php echo $nomEtablissement; ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                            class="display-26 text-secondary me-2 font-weight-600"data-translate="diplomePage.Type de Formation</">span>
                                        <?php echo $nomFormation; ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span
                                            class="display-26 text-secondary me-2 font-weight-600"data-translate="diplomePage.Filière"></span>
                                        <?php echo $intituleFiliere; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section pour les Informations de la Première Année -->
                <div class="col-lg-4 mb-4 mb-sm-5" id="cadre">
                    <div class="card border-0 section">
                        <div class="card-body">
                            <a href="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='releveeDeNotes1']/file")->item(0)->nodeValue; ?>" target="_blank">
                                <img src="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='releveeDeNotes1']/file")->item(0)->nodeValue; ?>" alt="Relevé de notes 1" id="fixed-size-image">
                            </a>
                            <h2 class="h3 mb-4"data-translate="diplomePage.Informations de la Première Année"></h2>
                            <ul class="list-unstyled mb-0">
                                <!-- Affichage des détails de la première année -->
                                <li><span class="text-secondary me-2 font-weight-600" data-translate="diplomePage.Année"></span><?php echo $anneePremiereAnnee; ?>
                                </li>
                                <li><span class="text-secondary me-2 font-weight-600"data-translate="diplomePage.Nombre
                                        d'Étudiants"></span><?php echo $nombreEtudiantPremiereAnnee; ?></li>
                                <li><span
                                        class="text-secondary me-2 font-weight-600" data-translate="diplomePage.Moyenne"></span><?php echo $moyennePremiereAnnee; ?>
                                </li>
                                <li><span
                                        class="text-secondary me-2 font-weight-600" data-translate="diplomePage.Classement"></span><?php echo $classementPremiereAnnee; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section pour les Informations de la Deuxième Année -->
                <div class="col-lg-4 mb-4 mb-sm-5" id="cadre">
                    <div class="card border-0 section">
                        <div class="card-body">
                            <a href="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='releveeDeNotes2']/file")->item(0)->nodeValue; ?>" target="_blank">
                                <img src="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='releveeDeNotes2']/file")->item(0)->nodeValue; ?>" alt="Relevé de notes 2" id="fixed-size-image">
                            </a>
                            <h2 class="h3 mb-4"data-translate="diplomePage.Informations de la Deuxième Année"></h2>
                            <ul class="list-unstyled mb-0">
                                <!-- Affichage des détails de la deuxième année -->
                                <li><span class="text-secondary me-2 font-weight-600"data-translate="diplomePage.Année"></span><?php echo $anneeDeuxiemeAnnee; ?>
                                </li>
                                <li><span class="text-secondary me-2 font-weight-600"data-translate="diplomePage.Nombre
                                        d'Étudiants"></span><?php echo $nombreEtudiantDeuxiemeAnnee; ?></li>
                                <li><span
                                        class="text-secondary me-2 font-weight-600"data-translate="diplomePage.Moyenne"></span><?php echo $moyenneDeuxiemeAnnee; ?>
                                </li>
                                <li><span
                                        class="text-secondary me-2 font-weight-600"data-translate="diplomePage.Classement"></span><?php echo $classementDeuxiemeAnnee; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if($ModifierInfosPersonnelles){?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-translate="diplomePage.Modifier les informations du diplome">
                </button>
                <?php }?>
                <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../XmlOperations/modifyDiplomeInfo.php"
                                    enctype="multipart/form-data">
                                    <div class="diplome-details mt-3">
                                        <h3 data-translate="diplome_details">Diplome</h3>

                                        <!-- Première Année -->
                                        <div class="annee-details mt-3">
                                            <div class="input-group">
                                                <?php
                                                $xml = new DOMDocument();
                                                $xml->load('../xml/baseXml.xml');
                                                $xpath = new DOMXPath($xml);
                                                $mentions = $xpath->query('//Mention');
                                                ?>
                                                <label data-translate="mention_label" for="mention1">Mention :</label>
                                                <select name="mentionDiplome" id="mention1">
                                                    <option value="" data-translate="Choisissez une option">
                                                        Choisissez une
                                                        option</option> <?php foreach ($mentions as $mention) : ?>
                                                    <option value="<?php echo $mention->getAttribute('idMention'); ?>">
                                                        <?php echo $mention->nodeValue; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <?php
                                                $xml = new DOMDocument();
                                                $xml->load('../xml/baseXml.xml');
                                                $xpath = new DOMXPath($xml);
                                                $TypeFormations = $xpath->query('//TypeFormation');
                                                ?>
                                                <label data-translate="type_formation_label" for="TypeFormation">Type
                                                    de formation
                                                    :</label> <select name="TypeFormation" id="TypeFormation"
                                                    onchange="showFields()">
                                                    <option value="" data-translate="Choisissez une option">
                                                        Choisissez une
                                                        option</option> <?php foreach ($TypeFormations as $TypeFormation) : ?>
                                                    <option value="<?php echo $TypeFormation->getAttribute('idFormation'); ?>">
                                                        <?php echo $TypeFormation->nodeValue; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="formation1-3" style="display: none;">
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $Universites = $xpath->query('//Univesite');
                                                    ?>
                                                    <label data-translate="university_label"
                                                        for="universite">Université :</label>
                                                    <select name="" id="universite"
                                                        onchange="showEtablissements()">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($Universites as $Universite) : ?>
                                                        <option value="<?php echo $Universite->getAttribute('idUniversite'); ?>">
                                                            <?php echo $Universite->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $TypesEtablissements = $xpath->query('//TypeEtablissement');
                                                    ?>
                                                    <label data-translate="type_etablissement_label"
                                                        for="typeEtablissement">Type
                                                        d'établissement :</label> <select name=""
                                                        id="typeEtablissement" onchange="showEtablissements()">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($TypesEtablissements as $TypesEtablissement) : ?>
                                                        <option value="<?php echo $TypesEtablissement->getAttribute('idTypeEtablissement'); ?>">
                                                            <?php echo $TypesEtablissement->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $Etablissements = $xpath->query('//Etablissement');
                                                    ?>
                                                    <label data-translate="etablissement_label"
                                                        for="etablissement">Établissement
                                                        :</label> <select name="etablissement" id="etablissement">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($Etablissements as $Etablissement) : ?>
                                                        <option value="<?php echo $Etablissement->getAttribute('idEtablissement'); ?>">
                                                            <?php echo $Etablissement->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="formation4-5" style="display: none;">
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $Villes = $xpath->query('//Ville');
                                                    ?>
                                                    <label data-translate="ville_label" for="ville">Ville :</label>
                                                    <select name="" id="ville" onchange="showCentres()">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($Villes as $Ville) : ?>
                                                        <option value="<?php echo $Ville->getAttribute('idVille'); ?>">
                                                            <?php echo $Ville->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $TypeCentres = $xpath->query('//TypeCentre');
                                                    ?>
                                                    <label data-translate="type_centre_label" for="typeCentre">Type de
                                                        centre
                                                        :</label> <select name="" id="typeCentre"
                                                        onchange="showCentres()">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($TypeCentres as $TypeCentre) : ?>
                                                        <option value="<?php echo $TypeCentre->getAttribute('idType'); ?>">
                                                            <?php echo $TypeCentre->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group">
                                                    <?php
                                                    $xml = new DOMDocument();
                                                    $xml->load('../xml/baseXml.xml');
                                                    $xpath = new DOMXPath($xml);
                                                    $Centres = $xpath->query('//centre');
                                                    ?>
                                                    <label data-translate="centre_label" for="centre">Centre
                                                        :</label> <select name="centre" id="centre">
                                                        <option value="" data-translate="Choisissez une option">
                                                            Choisissez
                                                            une
                                                            option</option> <?php foreach ($Centres as $Centre) : ?>
                                                        <option value="<?php echo $Centre->getAttribute('idCentre'); ?>">
                                                            <?php echo $Centre->nodeValue; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <?php
                                                $xml = new DOMDocument();
                                                $xml->load('../xml/baseXml.xml');
                                                $xpath = new DOMXPath($xml);
                                                $FiliereDiplomes = $xpath->query('//FiliereDiplome');
                                                ?>
                                                <label data-translate="filiere_diplome_label"
                                                    for="FiliereDiplome">Filière du
                                                    diplôme :</label> <select name="FiliereDiplome"
                                                    id="FiliereDiplome">
                                                    <option value="" data-translate="Choisissez une option">
                                                        Choisissez une
                                                        option</option> <?php foreach ($FiliereDiplomes as $FiliereDiplome) : ?>
                                                    <option value="<?php echo $FiliereDiplome->getAttribute('idFiliere'); ?>">
                                                        <?php echo $FiliereDiplome->nodeValue; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photoProfil" class="form-label"data-translate="diplomePage.Baccalaureat"></label>
                                                <input type="file" class="form-control" id="photoProfil"
                                                    name="bac">
                                            </div>
                                        </div>

                                        <div class="annee-details mt-3">

                                            <h4 data-translate="Première Année">Première Année</h4>
                                            <label for="InofsPremiereAnnee-annee"
                                                data-translate="Année">Année:</label>
                                            <select id="InofsPremiereAnnee-annee" name="InofsPremiereAnnee-annee">
                                                <option value="">
                                                    <?= $anneePremiereAnnee ?> </option>
                                                <?php
                                                $currentYear = date('Y');
                                                for ($i = $currentYear; $i >= $currentYear - 9; $i--) {
                                                    $nextYear = $i + 1;
                                                    echo "<option value='$i-$nextYear'>$i-$nextYear</option>";
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <!-- Première Année -->
                                            <label for="InofsPremiereAnnee-NombreEtudiant"
                                                data-translate="Nombre d'Étudiants">Nombre d'Étudiants :</label>
                                            <input type="text" id="InofsPremiereAnnee-NombreEtudiant"
                                                name="InofsPremiereAnnee-NombreEtudiant" placeholder="Ex. 150"
                                                value="<?= $nombreEtudiantPremiereAnnee ?>">
                                            <br>
                                            <label for="InofsPremiereAnnee-moyenne" data-translate="Moyenne">Moyenne
                                                :</label>
                                            <input type="number" id="InofsPremiereAnnee-moyenne"
                                                name="InofsPremiereAnnee-moyenne" placeholder="Ex. 15.5"
                                                value="<?= $moyennePremiereAnnee ?>" max="20">
                                            <br>
                                            <label for="InofsPremiereAnnee-classement"
                                                data-translate="Classement">Classement
                                                :</label>
                                            <input type="text" id="InofsPremiereAnnee-classement"
                                                name="InofsPremiereAnnee-classement" placeholder="Ex. 1er sur 100"
                                                value="<?= $classementPremiereAnnee ?>">
                                            <div class="mb-3">
                                                <label for="photoProfil" class="form-label"data-translate="diplomePage.Relevé de notes de
                                                    première année"></label>
                                                <input type="file" class="form-control" id="photoProfil"
                                                    name="rnpa">
                                            </div>
                                        </div>
                                        <!-- Deuxième Année -->
                                        <div class="annee-details mt-3">
                                            <h4 data-translate="Deuxième Année">Deuxième Année</h4>
                                            <label for="InofsDouxiemeAnnee-annee"
                                                data-translate="Année:">Année:</label>
                                            <select id="InofsDouxiemeAnnee-annee" name="InofsDouxiemeAnnee-annee">
                                                <option value="">
                                                    <?= $anneeDeuxiemeAnnee ?> </option>
                                                <?php
                                                $currentYear = date('Y');
                                                for ($i = $currentYear; $i >= $currentYear - 9; $i--) {
                                                    $nextYear = $i + 1;
                                                    echo "<option value='$i-$nextYear'>$i-$nextYear</option>";
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <label for="InofsPremiereAnnee-NombreEtudiant"
                                                data-translate="Nombre d'Étudiants :">Nombre d'Étudiants :</label>
                                            <input type="text" id="InofsPremiereAnnee-NombreEtudiant"
                                                name="InofsDouxiemeAnnee-NombreEtudiant" placeholder="Ex. 150"
                                                value=" <?php echo $nombreEtudiantDeuxiemeAnnee; ?>">
                                            <br>
                                            <label for="InofsPremiereAnnee-moyenne" data-translate="Moyenne :">Moyenne
                                                :</label>
                                            <input type="number" id="InofsPremiereAnnee-moyenne"
                                                name="InofsDouxiemeAnnee-moyenne" placeholder="Ex. 15.5"
                                                value="<?php echo $moyenneDeuxiemeAnnee; ?>" max="20">
                                            <br>
                                            <label for="InofsPremiereAnnee-classement"
                                                data-translate="Classement :">Classement
                                                :</label>
                                            <input type="text" id="InofsPremiereAnnee-classement"
                                                name="InofsDouxiemeAnnee-classement" placeholder="Ex. 1er sur 100"
                                                value="<?php echo $classementDeuxiemeAnnee; ?>">
                                            <div class="mb-3">
                                                <label for="photoProfil" class="form-label"data-translate="diplomePage.Relevé de notes de
                                                    deuxième année"></label>
                                                <input type="file" class="form-control" id="photoProfil"
                                                    name="rnda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"data-translate="candidaturePage.Modification.Fermer"></button>
                                        <button type="submit" class="btn btn-primary"data-translate="candidaturePage.Modification.Enregistrer les changements"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        .profile-pic {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #000;
            margin-left: 180px;
        }

        .profile-pic img {
            width: 100%;
            height: auto;
            display: block;
        }

        .card-style1 {
            box-shadow: 0px 0px 10px 0px rgb(89 75 128 / 9%);
        }

        .border-0 {
            border: 0 !important;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }

        section {
            padding: 120px 0;
            overflow: hidden;
            background: #fff;
        }

        #cadre {
            border: 1px solid #15395A;
            border-radius: 5px;
            margin-bottom: 20px;        }

        .mb-2-3,
        .my-2-3 {
            margin-bottom: 2.3rem;
        }

        .section-title {
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .text-primary {
            color: #ceaa4d !important;
        }

        .text-secondary {
            color: #15395A !important;
        }

        .font-weight-600 {
            font-weight: 600;
        }

        .display-26 {
            font-size: 1.3rem;
        }

        @media screen and (min-width: 992px) {
            .p-lg-7 {
                padding: 4rem;
            }
        }

        @media screen and (min-width: 768px) {
            .p-md-6 {
                padding: 3.5rem;
            }
        }

        @media screen and (min-width: 576px) {
            .p-sm-2-3 {
                padding: 2.3rem;
            }
        }

        .p-1-9 {
            padding: 1.9rem;
        }

        .bg-secondary {
            background: #15395A !important;
        }

        @media screen and (min-width: 576px) {

            .pe-sm-6,
            .px-sm-6 {
                padding-right: 3.5rem;
            }
        }

        @media screen and (min-width: 576px) {

            .ps-sm-6,
            .px-sm-6 {
                padding-left: 3.5rem;
            }
        }

        .pe-1-9,
        .px-1-9 {
            padding-right: 1.9rem;
        }

        .ps-1-9,
        .px-1-9 {
            padding-left: 1.9rem;
        }

        .pb-1-9,
        .py-1-9 {
            padding-bottom: 1.9rem;
        }

        .pt-1-9,
        .py-1-9 {
            padding-top: 1.9rem;
        }

        .mb-1-9,
        .my-1-9 {
            margin-bottom: 1.9rem;
        }

        @media (min-width: 992px) {
            .d-lg-inline-block {
                display: inline-block !important;
            }
        }

        .rounded {
            border-radius: 0.25rem !important;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 6px;
            margin-right: 20px;
        }

        .card-body {
            flex: 1;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .card ul {
            list-style: none;
            padding: 0;
        }

        .card ul li {
            font-size: 18px;
            margin-bottom: 8px;
        }

        #fixed-size-image {
            width: 200px;
            height: auto;
        }
    </style>
    <?php include '../Layouts/footer.html'; ?>
    <?php
    
    if (isset($_GET['messageSuccess'])) {
        $messageSuccess = urldecode($_GET['messageSuccess']);
        echo "<script src='../node_modules/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
                                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                                swal('Succès', '$messageSuccess', 'success');
                                                                                            });
                                                                                            </script>";
    }
    if (isset($_GET['messageError'])) {
        $messageError = urldecode($_GET['messageError']);
        echo "<script src='../node_modules/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
                                                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                                                swal('Erreur', '$messageError', 'error');
                                                                                            });
                                                                                            </script>";
    }
    ?>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="Translation/language.js"></script>
    <script src="../assets/js/inscrire.js"></script>
    <script src="../assets/js/formInsert.js"></script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/languageConncet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
