<?php
include '../Translation/headerTranslationCandidatConnect.php';
// if (
//     isset($_SESSION['AccesForm']) && 
//     $_SESSION['AccesForm'] == false
// ) {
//     header("Location: ../Welcome/connecter.php");
//     exit(); 
// }

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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">

</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <div>
        <h2>Créer votre espace étudiant</h2>
        <div id="multi-step-form-container">
            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                <!-- Step 1 -->
                <li class="form-stepper-active text-center form-stepper-list" step="1">
                    <a class="mx-2">
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div class="label" data-translate="Informations personnelles">Informations personnelles</div>
                    </a>
                </li>
                <!-- Step 2 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="label text-muted" data-translate="Informations du Baccalauréat">Informations du
                            Baccalauréat</div>
                    </a>
                </li>
                <!-- Step 3 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="label text-muted" data-translate="Informations du diplôme">Informations du diplôme
                        </div>
                    </a>
                </li>
                <!-- Step 4 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="4">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>4</span>
                        </span>
                        <div class="label text-muted" data-translate="Les expériences professionnelles">Les expériences
                            professionnelles</div>
                    </a>
                </li>
                <!-- Step 5 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="5">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>5</span>
                        </span>
                        <div class="label text-muted" data-translate="Documents à uploader">Documents à uploader</div>
                    </a>
                </li>
            </ul>

            <!-- Step Wise Form Content -->
            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST"
                action="../XmlOperations/insertCandidat.php">
                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    <!-- Step 1 input fields -->
                    <div class="mt-3">
                        <label for="cne" data-translate="CNE">CNE:</label>
                        <input type="text" id="cne" name="CNE" required placeholder="Ex: K126328736">
                    </div>
                    <div class="mt-3">
                        <label for="apogee" data-translate="Apogée (Facultatif)">Apogée (Facultatif):</label>
                        <input type="text" id="apogee" name="appoge" placeholder="Ex: 26352572">
                    </div>
                    <div class="mt-3">
                        <?php
                        $xml = new DOMDocument();
                        $xml->load('../xml/baseXml.xml');
                        
                        $xpath = new DOMXPath($xml);
                        $regions = $xpath->query('//Region');
                        ?>
                        <label for="regions" data-translate="Région :">Région :</label>
                        <select name="" id="regions" onchange="showVilles()">
                            <option value="" data-translate="Choisissez une option">Choisissez une option
                            </option>
                            <?php foreach ($regions as $region) : ?>
                            <option value="<?php echo $region->getAttribute('idRegion'); ?>">
                                <?php echo $region->nodeValue; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <?php
                        $xml = new DOMDocument();
                        $xml->load('../xml/baseXml.xml');
                        $xpath = new DOMXPath($xml);
                        $Villes = $xpath->query('//Ville');
                        ?>
                        <label for="villes" data-translate="Ville :">Ville :</label>
                        <select name="Ville" id="villes">
                            <option value="">Choisissez une option</option>
                            <?php foreach ($Villes as $Ville) : ?>
                            <option value="<?php echo $Ville->getAttribute('idVille'); ?>">
                                <?php echo $Ville->nodeValue; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="email" data-translate="Email">Email:</label>
                        <input type="email" id="email" name="email" required
                            placeholder="Ex: ali.alami@example.com">
                    </div>
                    <div class="mt-3">
                        <label for="confirmEmail" data-translate="Confirmer Email">Confirmer Email:</label>
                        <input type="email" id="confirmEmail" name="" required
                            placeholder="Ex: ali.alami@example.com">
                    </div>
                    <div class="mt-3">
                        <label for="adresse1" data-translate="Adresse 1">Adresse 1:</label>
                        <input type="text" id="adresse" name="addresse1" required
                            placeholder="Ex: 123 Rue de Safi">
                    </div>
                    <div class="mt-3">
                        <label for="adresse2" data-translate="Adresse 2">Adresse 2:</label>
                        <input type="text" id="adresse" name="addresse2" placeholder="Ex: Appartement 12">
                    </div>
                    <div class="mt-3">
                        <label for="dateNaissance" data-translate="Date de Naissance">Date de Naissance:</label>
                        <input type="date" id="dateNaissance" name="dateNaissance" required
                            placeholder="Ex: 1990-01-01">
                    </div>
                    <div class="mt-3">
                        <label for="lieuNaissance" data-translate="Lieu de Naissance">Lieu de Naissance:</label>
                        <input type="text" id="lieuNaissance" name="lieuNaissance" required
                            placeholder="Ex: Safi, Maroc">
                    </div>

                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2"
                            data-translate="Next">Next</button>
                    </div>
                </section>

                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <!-- Step 2 input fields -->
                    <div id="bacDetailsContainer mt-3">
                        <!-- Initial fields for one set of Bac details -->
                        <div class="bac mt-3">
                            <div class="bac-details mt-3">
                                <div class="input-group">
                                    <label for="anneeBac" data-translate="Année du Baccalauréat:">Année du
                                        Baccalauréat:</label>
                                    <select id="anneeBac" name="anneeBac" required>
                                        <option value="" selected disabled
                                            data-translate="Choisissez une année">Choisissez une année</option>
                                        <?php
                                        $currentYear = date('Y');
                                        for ($i = $currentYear; $i >= $currentYear - 9; $i--) {
                                            $nextYear = $i + 1;
                                            echo "<option value='$i-$nextYear'>$i-$nextYear</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label for="noteBac1" data-translate="Note au Baccalauréat:">Note au
                                        Baccalauréat:</label>
                                    <input type="text" id="noteBac" name="noteBac" required
                                        placeholder="Ex: 15/20">
                                </div>
                            </div>
                            <div class="bac-details mt-3">
                                <div class="input-group">
                                    <?php
                                    $xml = new DOMDocument();
                                    $xml->load('../xml/baseXml.xml');
                                    $xpath = new DOMXPath($xml);
                                    $academies = $xpath->query('//Accademie');
                                    ?>
                                    <label for="academieBac1" data-translate="Académie :">Académie :</label>
                                    <select name="academieBac" id="academieBac">
                                        <option value="" data-translate="Choisissez une option">Choisissez une
                                            option</option>
                                        <?php foreach ($academies as $academie) : ?>
                                        <option value="<?php echo $academie->getAttribute('idAcademie'); ?>">
                                            <?php echo $academie->nodeValue; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <?php
                                    $xml = new DOMDocument();
                                    $xml->load('../xml/baseXml.xml');
                                    $xpath = new DOMXPath($xml);
                                    $typesBac = $xpath->query('//TypeBac');
                                    ?>
                                    <label for="typeBac" data-translate="Type de Bac :">Type de Bac :</label>
                                    <select name="typeBac" id="typeBac">
                                        <option value="" data-translate="Choisissez une option">Choisissez une
                                            option</option>
                                        <?php foreach ($typesBac as $typeBac) : ?>
                                        <option value="<?php echo $typeBac->getAttribute('idType'); ?>">
                                            <?php echo $typeBac->nodeValue; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <?php
                                    $xml = new DOMDocument();
                                    $xml->load('../xml/baseXml.xml');
                                    $xpath = new DOMXPath($xml);
                                    $mentions = $xpath->query('//Mention');
                                    ?>
                                    <label for="mention1" data-translate="Mention :">Mention :</label>
                                    <select name="mentionBac" id="mention1" required>
                                        <option value="" data-translate="Choisissez une option">Choisissez une
                                            option</option>
                                        <?php foreach ($mentions as $mention) : ?>
                                        <option value="<?php echo $mention->getAttribute('idMention'); ?>">
                                            <?php echo $mention->nodeValue; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="1" id="Botona"
                            data-translate="Prev">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3" id="Botona"
                            data-translate="Next">Next</button>
                    </div>
                </section>
                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <!-- Step 3 input fields -->
                    <div class="mt-3">
                        <!-- Diplôme avec deux années -->
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
                                    <label data-translate="mention_label" for="mention1">Mention :</label> <select
                                        name="mentionDiplome" id="mention1" required>
                                        <option value="" data-translate="Choisissez une option">Choisissez une
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
                                    <label data-translate="type_formation_label" for="TypeFormation">Type de formation
                                        :</label> <select name="TypeFormation" id="TypeFormation"
                                        onchange="showFields()" required>
                                        <option value="" data-translate="Choisissez une option">Choisissez une
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
                                        <label data-translate="university_label" for="universite">Université :</label>
                                        <select name="" id="universite" onchange="showEtablissements()">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                        <label data-translate="type_etablissement_label" for="typeEtablissement">Type
                                            d'établissement :</label> <select name="" id="typeEtablissement"
                                            onchange="showEtablissements()">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                        <label data-translate="etablissement_label" for="etablissement">Établissement
                                            :</label> <select name="etablissement" id="etablissement">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                        <label data-translate="ville_label" for="ville">Ville :</label> <select
                                            name="" id="ville" onchange="showCentres()">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                        <label data-translate="type_centre_label" for="typeCentre">Type de centre
                                            :</label> <select name="" id="typeCentre"
                                            onchange="showCentres()">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                        <label data-translate="centre_label" for="centre">Centre :</label> <select
                                            name="centre" id="centre">
                                            <option value="" data-translate="Choisissez une option">Choisissez
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
                                    <label data-translate="filiere_diplome_label" for="FiliereDiplome">Filière du
                                        diplôme :</label> <select name="FiliereDiplome" id="FiliereDiplome">
                                        <option value="" data-translate="Choisissez une option">Choisissez une
                                            option</option> <?php foreach ($FiliereDiplomes as $FiliereDiplome) : ?>
                                        <option value="<?php echo $FiliereDiplome->getAttribute('idFiliere'); ?>">
                                            <?php echo $FiliereDiplome->nodeValue; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="annee-details mt-3">

                                <h4 data-translate="Première Année">Première Année</h4>
                                <label for="InofsPremiereAnnee-annee" data-translate="Année">Année:</label>
                                <select id="InofsPremiereAnnee-annee" name="InofsPremiereAnnee-annee" required>
                                    <option value="" selected data-translate="Choisissez une année">Choisissez
                                        une année</option>
                                    <?php
                                    // Obtenir l'année actuelle
                                    $currentYear = date('Y');
                                    
                                    // Remplir les options des 10 dernières années pour la première année
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
                                    name="InofsPremiereAnnee-NombreEtudiant" placeholder="Ex. 150" required>
                                <br>

                                <label for="InofsPremiereAnnee-moyenne" data-translate="Moyenne">Moyenne :</label>
                                <input type="text" id="InofsPremiereAnnee-moyenne"
                                    name="InofsPremiereAnnee-moyenne" placeholder="Ex. 15.5" required>
                                <br>

                                <label for="InofsPremiereAnnee-classement" data-translate="Classement">Classement
                                    :</label>
                                <input type="text" id="InofsPremiereAnnee-classement"
                                    name="InofsPremiereAnnee-classement" placeholder="Ex. 1er sur 100" required>

                            </div>

                            <!-- Deuxième Année -->
                            <div class="annee-details mt-3">
                                <h4 data-translate="Deuxième Année">Deuxième Année</h4>
                                <label for="InofsDouxiemeAnnee-annee" data-translate="Année:">Année:</label>
                                <select id="InofsDouxiemeAnnee-annee" name="InofsDouxiemeAnnee-annee" required>
                                    <option value="" selected disabled data-translate="Choisissez une année">
                                        Choisissez une année</option>
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
                                    name="InofsDouxiemeAnnee-NombreEtudiant" placeholder="Ex. 150" required>
                                <br>
                                <label for="InofsPremiereAnnee-moyenne" data-translate="Moyenne :">Moyenne :</label>
                                <input type="text" id="InofsPremiereAnnee-moyenne"
                                    name="InofsDouxiemeAnnee-moyenne" placeholder="Ex. 15.5" required>
                                <br>
                                <label for="InofsPremiereAnnee-classement" data-translate="Classement :">Classement
                                    :</label>
                                <input type="text" id="InofsPremiereAnnee-classement"
                                    name="InofsDouxiemeAnnee-classement" placeholder="Ex. 1er sur 100" required>
                            </div>

                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" data-translate="Prev"
                            step_number="2">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" data-translate="Next"
                            step_number="4">Next</button>
                    </div>
                </section>

                <section id="step-4" class="form-step d-none">
                    <!-- Step 4 input fields -->
                    <div class="experience-details mt-3">
                        <h3 data-translate="Expérience Professionnelle">Expérience Professionnelle</h3>

                        <!-- Champ textarea pour l'expérience professionnelle -->
                        <label for="experiencePro" data-translate="Expérience Professionnelle:">Expérience
                            Professionnelle:</label>
                        <textarea id="experiencePro" name="experiencePro" required rows="6"></textarea>

                        <!-- Champ pour le nombre d'années d'expérience -->
                        <label for="nombreAnne" data-translate="Nombre d'années d'expérience:">Nombre d'années
                            d'expérience:</label>
                        <input type="number" id="nombreAnne" name="nombreAnne" required>
                    </div>


                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" data-translate="Prev"
                            step_number="3">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" data-translate="Next"
                            step_number="5">Next</button>
                    </div>
                </section>
                <section id="step-5" class="form-step d-none">
                    <!-- Step 4 input fields -->
                    <div class="file-details mt-3">
                        <h3 data-translate="Fichiers">Files</h3>
                        <!-- Baccalauréat -->
                        <label for="baccalaureat" data-translate="Baccalauréat:">Baccalauréat:</label>
                        <input type="file" id="baccalaureat" name="baccalaureat" accept=".jpg,.png,.jpeg"
                            required>

                        <!-- Attestation de réussite ou diplôme -->
                        <label for="attestation" data-translate="Attestation de réussite ou diplôme:">Attestation de
                            réussite ou diplôme:</label>
                        <input type="file" id="attestation" name="diplomeBac2" accept=".jpg,.png,.jpeg" required>

                        <!-- Relevé de notes S1 -->
                        <label for="releveS1" data-translate="Relevé de notes S1:">Relevé de notes S1:</label>
                        <input type="file" id="releveS1" name="releveeDeNotes1" accept=".jpg,.png,.jpeg"
                            required>

                        <!-- Relevé de notes S2 -->
                        <label for="releveS2" data-translate="Relevé de notes S2:">Relevé de notes S2:</label>
                        <input type="file" id="releveS2" name="releveeDeNotes2" accept=".jpg,.png,.jpeg"
                            required>
                        <label for="photo" data-translate="Photo personnel:">Photo personnel:</label>
                        <input type="file" id="photo" name="photoProfil" accept=".jpg,.png,.jpeg" required>

                        <!-- Copie de CIN -->
                        <label for="cinCopy" data-translate="Copie de CIN:">Copie de CIN:</label>
                        <input type="file" id="cinCopy" name="copieCIN" accept=".jpg,.png,.jpeg" required>
                    </div>

                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="4"   data-translate="Prev">Prev</button>
                        <button class="button submit-btn" type="submit"    data-translate="send">Save</button>
                    </div>
                </section>


            </form>
        </div>
    </div>
    <style>
        h1,
        h2 {
            text-align: center;
        }


        #multi-step-form-container {
            margin-top: 2rem;
        }

        .text-center {
            text-align: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .pl-0 {
            padding-left: 0;
        }

        .button {
            padding: 0.7rem 1.5rem;
            border: 1px solid #4361ee;
            background-color: #4361ee;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn {
            border: 1px solid #0e9594;
            background-color: #0e9594;
        }

        .mt-3 {
            margin-top: 2rem;
        }

        .d-none {
            display: none;
        }

        .form-step {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 3rem;
        }

        .font-normal {
            font-weight: normal;
        }

        ul.form-stepper {
            counter-reset: section;
            margin-bottom: 3rem;
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
        }

        ul.form-stepper .form-stepper-circle {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 40px;
            margin-right: 0;
            line-height: 1.7rem;
            text-align: center;
            background: rgba(0, 0, 0, 0.38);
            border-radius: 50%;
        }

        ul.form-stepper .form-stepper-circle span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
        }

        .form-stepper-horizontal {
            position: relative;
            display: flex;
            justify-content: space-between;
            width: 70%;
        }

        ul.form-stepper>li:not(:last-of-type) {
            margin-bottom: 0.625rem;
            transition: margin-bottom 0.4s;
        }

        .form-stepper-horizontal>li:not(:last-of-type) {
            margin-bottom: 0 !important;
        }

        .form-stepper-horizontal li {
            position: relative;
            display: flex;
            flex: 1;
            align-items: start;
            transition: 0.5s;
        }

        .form-stepper-horizontal li:not(:last-child):after {
            position: relative;
            flex: 1;
            height: 1px;
            content: "";
            top: 32%;
            background-color: #dee2e6;
        }

        .form-stepper-horizontal li:after {
            background-color: #dee2e6;
        }

        .form-stepper-horizontal li.form-stepper-completed:after {
            background-color: #4da3ff;
        }

        .form-stepper-horizontal li:last-child {
            flex: unset;
        }


        /* Style pour la section avec l'ID step-2 */
        #step-2 {
            display: flex;
            flex-wrap: wrap;
        }

        /* Style pour chaque groupe de détails Bac */
        .bac-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Espacement entre les éléments */
            margin-top: 10px;
            /* Marge supérieure entre chaque groupe */
        }

        /* Style pour chaque élément de formulaire dans un groupe de détails Bac */
        .input-group {
            flex: 1 1 calc(50% - 10px);
            /* Deux éléments par ligne avec espacement */
        }

        /* Style pour les boutons en bas */
        #step-2>div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            /* Espacement par rapport aux éléments précédents */
        }

        /* Style pour les boutons individuels */
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Style pour les boutons de navigation */
        .btn-navigate-form-step {
            background-color: #28a745;
            /* Couleur pour le bouton Next */
        }



        .form-stepper .form-stepper-active .form-stepper-circle {
            background-color: #33a5ff !important;
            color: #fff;
        }

        .form-stepper .form-stepper-active .label {
            color: #33a5ff !important;
        }

        .form-stepper .form-stepper-active .form-stepper-circle:hover {
            background-color: #33a5ff !important;
            color: #fff !important;
        }

        .form-stepper .form-stepper-unfinished .form-stepper-circle {
            background-color: #f8f7ff;
        }

        .form-stepper .form-stepper-completed .form-stepper-circle {
            background-color: #248010 !important;
            color: #fff;
        }

        .form-stepper .form-stepper-completed .label {
            color: #248010 !important;
        }

        .form-stepper .form-stepper-completed .form-stepper-circle:hover {
            background-color: #248010 !important;
            color: #fff !important;
        }

        .form-stepper .form-stepper-active span.text-muted {
            color: #fff !important;
        }

        .form-stepper .form-stepper-completed span.text-muted {
            color: #fff !important;
        }

        .form-stepper .label {
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .form-stepper a {
            cursor: default;
        }

        /* Styles généraux */

        /* Police et espacement pour une meilleure lisibilité */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8;
            /* Couleur de fond générale */
            margin: 0;
            /* Supprime les marges par défaut du navigateur */
            padding: 0;
            /* Supprime les rembourrages par défaut du navigateur */
        }

        /* Couleur de texte pour les éléments importants */
        h1,
        h2,
        h3 {
            color: #000;
        }

        /* Étapes du formulaire */

        /* Conteneur des étapes */
        .form-step {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 1fr;
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Styles des libellés */
        label {
            font-weight: bold;
        }

        /* Styles des champs de saisie */

        /* Champs de saisie principaux */
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Effets sur les champs de saisie */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus {
            border-color: #4361ee;
            outline: none;
        }

        /* Styles pour les boutons */
        .button {
            transition: all 0.3s ease-in-out;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }

        .button:hover {
            transform: scale(1.1);
            background-color: #4361ee;
            color: #fff;
        }

        /* Styles pour les erreurs */
        input[type="text"].error,
        input[type="email"].error,
        input[type="date"].error {
            border-color: #ff4757;
        }

        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
        }



        /* Effet de profondeur sur les sélecteurs */
        select {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style pour les erreurs */
        select.error {
            border-color: #ff4757;
        }

        /* Style pour regrouper chaque paire d'input dans une ligne */
        .diplome-details {
            display: flex;
            flex-direction: column;
        }

        .annee-details {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .annee-details label {
            margin-bottom: 5px;
        }

        .annee-details input {
            margin-bottom: 10px;
            padding: 5px;
        }

        /* Alignement horizontal des labels et des inputs */
        .annee-details label,
        .annee-details input {
            display: inline-block;
            width: 50%;
        }

        /* Style pour la section avec l'ID step-3 */
        #step-3 {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Espacement entre les éléments */
        }

        /* Style pour le groupe de détails du diplôme avec deux années */
        .diplome-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Espacement entre les sections de chaque année */
        }

        /* Style pour chaque année */
        .annee-details {
            border: 1px solid #ccc;
            /* Bordure autour de chaque année */
            padding: 15px;
            /* Espacement intérieur */
            border-radius: 5px;
            /* Coins arrondis */
        }

        /* Style pour les titres des années */
        .annee-details h4 {
            margin-top: 0;
            /* Supprime la marge supérieure par défaut */
        }

        /* Style pour les étiquettes et les champs de saisie */
        .annee-details label {
            display: block;
            /* Affiche les étiquettes sur une nouvelle ligne */
            margin-bottom: 5px;
            /* Espacement entre les étiquettes */
        }

        .annee-details input[type="text"] {
            width: 100%;
            /* Prend la largeur totale */
            padding: 8px;
            /* Espacement intérieur */
            margin-bottom: 10px;
            /* Espacement entre les champs */
            border-radius: 3px;
            /* Coins arrondis pour les champs */
            border: 1px solid #ccc;
            /* Bordure */
        }

        /* Style pour les boutons en bas */
        #step-3>div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 20px;
            /* Espacement par rapport aux éléments précédents */
        }

        #step-2>div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 20px;
            /* Espacement par rapport aux éléments précédents */
        }

        /* Style pour les boutons individuels */
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Style pour les boutons de navigation */
        .btn-navigate-form-step {
            background-color: #28a745;
            /* Couleur pour le bouton Prev */
        }

        /* Style pour le bouton Next */
        #step-3 .btn-navigate-form-step:last-child {
            background-color: #dc3545;
            /* Couleur pour le bouton Next */
        }

        #step-4 .btn-navigate-form-step:last-child {
            background-color: #dc3545;
            /* Couleur pour le bouton Next */
        }

        #step-2 .btn-navigate-form-step:last-child {
            background-color: #dc3545;
            /* Couleur pour le bouton Next */
        }


        /* Style pour le champ textarea */
        .experience-details textarea {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: vertical;
            /* Permet à l'utilisateur de redimensionner verticalement */
        }

        /* Style pour la section avec l'ID step-4 */
        #step-4 {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Espacement entre les éléments */
        }

        /* Style pour chaque groupe de détails */
        .experience-details {
            border: 1px solid #ccc;
            /* Bordure autour des détails */
            padding: 15px;
            /* Espacement intérieur */
            border-radius: 5px;
            /* Coins arrondis */
        }

        /* Style pour les titres des détails */
        .experience-details h3 {
            margin-top: 0;
            /* Supprime la marge supérieure par défaut */
        }

        /* Style pour les étiquettes et les champs de saisie */
        .experience-details label {
            display: block;
            /* Affiche les étiquettes sur une nouvelle ligne */
            margin-bottom: 5px;
            /* Espacement entre les étiquettes */
        }

        .experience-details input[type="number"],
        .experience-details textarea {
            width: 100%;
            /* Prend la largeur totale */
            padding: 8px;
            /* Espacement intérieur */
            margin-bottom: 10px;
            /* Espacement entre les champs */
            border-radius: 3px;
            /* Coins arrondis pour les champs */
            border: 1px solid #ccc;
            /* Bordure */
        }

        /* Style pour les boutons en bas */
        #step-4>div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 20px;
            /* Espacement par rapport aux éléments précédents */
        }

        /* Style pour les boutons individuels */
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Style pour le bouton de navigation Prev */
        .btn-navigate-form-step {
            background-color: #28a745;
        }

        /* Style pour le bouton Save */
        .submit-btn {
            background-color: #dc3545;
        }

        /* Style pour la section avec l'ID step-5 */
        #step-5 {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Espacement entre les éléments */
        }

        /* Style pour le groupe de détails des fichiers */
        .file-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            /* Espacement entre les sections de chaque fichier */
        }

        /* Style pour chaque fichier */
        .file-details label {
            display: block;
            /* Affiche les étiquettes sur une nouvelle ligne */
            margin-bottom: 5px;
            /* Espacement entre les étiquettes */
        }

        .file-details input[type="file"] {
            width: 100%;
            /* Prend la largeur totale */
            padding: 8px;
            /* Espacement intérieur */
            margin-bottom: 10px;
            /* Espacement entre les champs */
            border-radius: 3px;
            /* Coins arrondis pour les champs */
            border: 1px solid #ccc;
            /* Bordure */
        }

        /* Style pour les boutons en bas */
        #step-5>div:last-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 20px;
            /* Espacement par rapport aux éléments précédents */
        }

        /* Style pour les boutons individuels */
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Style pour le bouton Prev */
        .btn-navigate-form-step {
            background-color: #28a745;
        }

        /* Style pour le bouton Save */
        .submit-btn {
            background-color: #dc3545;
        }



        /* Autres styles pour les autres éléments si besoin */
    </style>


    <script>
        /**
         * Define a function to navigate betweens form steps.
         * It accepts one parameter. That is - step number.
         */
        const navigateToFormStep = (stepNumber) => {
            /**
             * Hide all form steps.
             */
            document.querySelectorAll(".form-step").forEach((formStepElement) => {
                formStepElement.classList.add("d-none");
            });
            /**
             * Mark all form steps as unfinished.
             */
            document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
                formStepHeader.classList.add("form-stepper-unfinished");
                formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
            });
            /**
             * Show the current form step (as passed to the function).
             */
            document.querySelector("#step-" + stepNumber).classList.remove("d-none");
            /**
             * Select the form step circle (progress bar).
             */
            const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
            /**
             * Mark the current form step as active.
             */
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
            formStepCircle.classList.add("form-stepper-active");
            /**
             * Loop through each form step circles.
             * This loop will continue up to the current step number.
             * Example: If the current step is 3,
             * then the loop will perform operations for step 1 and 2.
             */
            for (let index = 0; index < stepNumber; index++) {
                /**
                 * Select the form step circle (progress bar).
                 */
                const formStepCircle = document.querySelector('li[step="' + index + '"]');
                /**
                 * Check if the element exist. If yes, then proceed.
                 */
                if (formStepCircle) {
                    /**
                     * Mark the form step as completed.
                     */
                    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
                    formStepCircle.classList.add("form-stepper-completed");
                }
            }
        };
        /**
         * Select all form navigation buttons, and loop through them.
         */
        document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
            /**
             * Add a click event listener to the button.
             */
            formNavigationBtn.addEventListener("click", () => {
                /**
                 * Get the value of the step.
                 */
                const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
                /**
                 * Call the function to navigate to the target form step.
                 */
                navigateToFormStep(stepNumber);
            });
        });


        // JavaScript pour ajouter dynamiquement des champs pour le baccalauréat
    </script>
    <?php include '../Layouts/footer.html'; ?>
    <?php
    // session_start();
    
    if (isset($_GET['messageSuccess'])) {
        $messageSuccess = urldecode($_GET['messageSuccess']);
        echo "<script src='node_modules/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
                                                                                                                                                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                                                                                                                                                    swal('Succès', '$messageSuccess', 'success');
                                                                                                                                                                                                });
                                                                                                                                                                                              </script>";
    }
    if (isset($_GET['messageError'])) {
        $messageError = urldecode($_GET['messageError']);
        echo "<script src='node_modules/sweetalert/dist/sweetalert.min.js'></script>";
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
    <script src="assets/js/inscrire.js"></script>
    <script>
        function showFields() {
            var typeFormation = document.getElementById("TypeFormation");
            var selectedValue = typeFormation.options[typeFormation.selectedIndex].value;

            var formation1to3Div = document.querySelector('.formation1-3');
            var formation4to5Div = document.querySelector('.formation4-5');

            if (selectedValue === "formation1" || selectedValue === "formation2" || selectedValue === "formation3") {
                formation1to3Div.style.display = 'block';
                formation4to5Div.style.display = 'none';
            } else if (selectedValue === "formation4" || selectedValue === "formation5") {
                formation1to3Div.style.display = 'none';
                formation4to5Div.style.display = 'block';
            } else {
                formation1to3Div.style.display = 'none';
                formation4to5Div.style.display = 'none';
            }
        }

        // Fonction pour charger et traiter le fichier XML
        function loadXMLDoc(filename) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", filename, false);
            xhttp.send();
            return xhttp.responseXML;
        }

        // Afficher les établissements en fonction de l'université sélectionnée
        function showEtablissements() {
            var universiteSelect = document.getElementById("universite");
            var typeEtablissementSelect = document.getElementById("typeEtablissement");
            var etablissementSelect = document.getElementById("etablissement");

            var selectedUniversite = universiteSelect.options[universiteSelect.selectedIndex].value;
            var selectedTypeEtablissement = typeEtablissementSelect.options[typeEtablissementSelect.selectedIndex].value;

            // Charger le fichier XML
            var xmlDoc = loadXMLDoc("../xml/baseXml.xml");

            // Récupérer tous les établissements
            var etablissements = xmlDoc.getElementsByTagName("Etablissement");

            // Effacer les options actuelles
            etablissementSelect.innerHTML = '';

            // Parcourir les établissements et afficher ceux correspondant à l'université et au type d'établissement sélectionnés
            for (var i = 0; i < etablissements.length; i++) {
                var universite = etablissements[i].getAttribute("Universite");
                var typeEtablissement = etablissements[i].getAttribute("TypeEtablissement");

                if (universite === selectedUniversite && typeEtablissement === selectedTypeEtablissement) {
                    var nomEtablissement = etablissements[i].getElementsByTagName("nomEtablissement")[0].childNodes[0]
                        .nodeValue;
                    var idEtablissement = etablissements[i].getAttribute("idEtablissement");
                    var option = document.createElement("option");
                    option.text = nomEtablissement;
                    option.value = idEtablissement;
                    etablissementSelect.add(option);
                }
            }
        }

        // Remplir les options de sélection initiales lors du chargement de la page
        window.onload = function() {
            showEtablissements
                (); // Pour remplir les établissements initialement en fonction de l'université et du type d'établissement
        };

        function showCentres() {
            var villeSelect = document.getElementById("ville");
            var typeCentreSelect = document.getElementById("typeCentre");
            var centreSelect = document.getElementById("centre");

            var selectedVille = villeSelect.options[villeSelect.selectedIndex].value;
            var selectedTypeCentre = typeCentreSelect.options[typeCentreSelect.selectedIndex].value;

            // Charger le fichier XML
            var xmlDoc = loadXMLDoc("../xml/baseXml.xml");

            // Récupérer toutes les villes, types de centre et centres
            var villes = xmlDoc.getElementsByTagName("Ville");
            var typesCentre = xmlDoc.getElementsByTagName("TypeCentre");
            var centres = xmlDoc.getElementsByTagName("centre");

            // Effacer les options actuelles
            centreSelect.innerHTML = '';

            // Afficher les centres correspondant à la ville et au type de centre sélectionnés
            for (var i = 0; i < centres.length; i++) {
                var ville = centres[i].getAttribute("idVille");
                var typeCentre = centres[i].getAttribute("idTypeCentre");

                if (ville === selectedVille && typeCentre === selectedTypeCentre) {
                    var nomCentre = centres[i].getElementsByTagName("NomCentre")[0].childNodes[0].nodeValue;
                    var idCentre = centres[i].getAttribute("idCentre");

                    var option = document.createElement("option");
                    option.text = nomCentre;
                    option.value = idCentre;
                    centreSelect.appendChild(option);
                }
            }
        }

        // Remplir les options de sélection initiales lors du chargement de la page
        window.onload = function() {
            showCentres(); // Pour remplir les centres initialement en fonction de la ville et du type de centre
        };


        function showVilles() {
            var regionSelect = document.getElementById("regions");
            var villeSelect = document.getElementById("villes");

            var selectedRegion = regionSelect.options[regionSelect.selectedIndex].value;

            // Charger le fichier XML
            var xmlDoc = loadXMLDoc("../xml/BaseXml.xml");

            // Récupérer toutes les villes
            var villes = xmlDoc.getElementsByTagName("Ville");

            // Effacer les options actuelles
            villeSelect.innerHTML = '';

            // Parcourir les villes et afficher celles correspondant à la région sélectionnée
            for (var i = 0; i < villes.length; i++) {
                var region = villes[i].getAttribute("region");

                if (region === selectedRegion) {
                    var nomVille = villes[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
                    var idVille = villes[i].getAttribute("idVille");

                    var option = document.createElement("option");
                    option.text = nomVille;
                    option.value = idVille;
                    villeSelect.add(option);
                }
            }
        }

        // Remplir les options de sélection initiales lors du chargement de la page
        window.onload = function() {
            showVilles(); // Pour remplir les villes initialement en fonction de la région sélectionnée
        };



        const emailField = document.getElementById('email');
        const confirmEmailField = document.getElementById('confirmEmail');

        emailField.addEventListener('input', validateEmails);
        confirmEmailField.addEventListener('input', validateEmails);

        confirmEmailField.addEventListener('blur', function() {
            if (emailField.value !== confirmEmailField.value) {
                confirmEmailField.style.borderColor = 'red';
                alert('Les adresses email ne correspondent pas. Veuillez les saisir à nouveau.');
                confirmEmailField.value = ''; // Réinitialisation du champ Confirm Email
            } else {
                confirmEmailField.style.borderColor = 'green';
            }
        });

        function validateEmails() {
            const email = emailField.value;
            const confirmEmail = confirmEmailField.value;

            if (email !== confirmEmail) {
                emailField.style.borderColor = 'red';
                confirmEmailField.style.borderColor = 'red';
            } else {
                emailField.style.borderColor = 'green';
                confirmEmailField.style.borderColor = 'green';
            }
        }
    </script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/languageConncet.js"></script>

</body>

</html>
