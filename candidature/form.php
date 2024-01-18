<?php
include '../Translation/headerTranslationCandidatConnect.php';
if (
    isset($_SESSION['AccesForm']) &&
    $_SESSION['AccesForm'] == false
) {
    header("Location: pageNonTrouve");
    exit();
}
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
    <link href="../assets/css/formInsert.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">

</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <div>
        <h2>Créer votre espace étudiant</h2>
        <div id="multi-step-form-container">
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
                        <select name="villeCandidat" id="villes">
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
                                    <input type="number" id="noteBac" name="noteBac" required
                                        placeholder="Ex: 15/20" max="20">
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
                                    name="InofsPremiereAnnee-NombreEtudiant" placeholder="Ex. 150" required>
                                <br>

                                <label for="InofsPremiereAnnee-moyenne" data-translate="Moyenne">Moyenne :</label>
                                <input type="number" id="InofsPremiereAnnee-moyenne"
                                    name="InofsPremiereAnnee-moyenne" placeholder="Ex. 15.5" required max="20">
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
                                <input type="number" id="InofsPremiereAnnee-moyenne"
                                    name="InofsDouxiemeAnnee-moyenne" placeholder="Ex. 15.5" required max="20">
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
                        <label for="baccalaureat" data-translate="Baccalauréat:">Baccalauréat:</label>
                        <input type="file" id="baccalaureat" name="baccalaureat" accept=".jpg,.png,.jpeg"
                            required>
                        <label for="attestation" data-translate="Attestation de réussite ou diplôme:">Attestation de
                            réussite ou diplôme:</label>
                        <input type="file" id="attestation" name="diplomeBac2" accept=".jpg,.png,.jpeg" required>
                        <label for="releveS1" data-translate="Relevé de notes S1:">Relevé de notes première année:</label>
                        <input type="file" id="releveS1" name="releveeDeNotes1" accept=".jpg,.png,.jpeg"
                            required>
                        <label for="releveS2" data-translate="Relevé de notes S2:">Relevé de deuxième année:</label>
                        <input type="file" id="releveS2" name="releveeDeNotes2" accept=".jpg,.png,.jpeg"
                            required>
                        <label for="photo" data-translate="Photo personnel:">Photo personnel:</label>
                        <input type="file" id="photo" name="photoProfil" accept=".jpg,.png,.jpeg" required>
                        <label for="cinCopy" data-translate="Copie de CIN:">Copie de CIN:</label>
                        <input type="file" id="cinCopy" name="copieCIN" accept=".jpg,.png,.jpeg" required>
                    </div>

                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="4"
                            data-translate="Prev">Prev</button>
                        <button class="button submit-btn" type="submit" data-translate="send">Save</button>
                    </div>
                </section>


            </form>
        </div>
    </div>
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
<script src="../assets/js/inscrire.js"></script>
    <script src="../assets/js/formInsert.js"></script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/languageConncet.js"></script>

</body>

</html>
