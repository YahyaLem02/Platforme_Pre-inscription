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
    <link href="../assets/css/DiplomeInfos.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <?php
    $xmlFile = '../xml/BaseXml.xml';
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    $xpath = new DOMXPath($xml);
    $candidatQuery = "//candidat[@Utilisateur='{$_SESSION['cin']}']";
    $candidat = $xpath->query($candidatQuery)->item(0);
    $mentionBac = '';
    $typeBac = '';
    $academie = '';
    $anneeBac = '';
    $noteBac = '';
    
    if ($candidat) {
        $mentionBacNode = $xpath->query('bac/@mentionBac', $candidat)->item(0);
        if ($mentionBacNode) {
            $mentionBac = $mentionBacNode->nodeValue;
        }
    
        $idTypeBacNode = $xpath->query('bac/@type', $candidat)->item(0);
        if ($idTypeBacNode) {
            $idTypeBac = $idTypeBacNode->nodeValue;
            $typeBacQuery = "//TypeBac[@idType='$idTypeBac']/nomType";
            $typeBacNode = $xpath->query($typeBacQuery)->item(0);
            if ($typeBacNode) {
                $typeBac = $typeBacNode->nodeValue;
            }
        }
    
        $idAcademieNode = $xpath->query('bac/@accadime', $candidat)->item(0);
        if ($idAcademieNode) {
            $idAcademie = $idAcademieNode->nodeValue;
            $academieQuery = "//Accademie[@idAcademie='$idAcademie']/nomAcademie";
            $academieNode = $xpath->query($academieQuery)->item(0);
            if ($academieNode) {
                $academie = $academieNode->nodeValue;
            }
        }
    
        $anneeBacNode = $xpath->query('bac/anneeBac', $candidat)->item(0);
        if ($anneeBacNode) {
            $anneeBac = $anneeBacNode->nodeValue;
        }
    
        $noteBacNode = $xpath->query('bac/noteBac', $candidat)->item(0);
        if ($noteBacNode) {
            $noteBac = $noteBacNode->nodeValue;
        }
    }
    ?>
    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card border-0">
                        <div class="card-body p-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <div class="profile-pic">
                                        <a href="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='baccalaureat']/file")->item(0)->nodeValue; ?>" target="_blank">
                                            <img src="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='baccalaureat']/file")->item(0)->nodeValue; ?>" alt="Relevé de notes 1"
                                                id="fixed-size-image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Informations du Bac -->
                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600"
                                                data-translate="bacPage.Type de Bac"></span>
                                            <?php echo $typeBac; ?>
                                        </li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600"
                                                data-translate="bacPage.Académie de Bac"></span>
                                            <?php echo $academie; ?>
                                        </li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600"data-translate="bacPage.Mention Bac"></span>
                                            <?php echo $mentionBac; ?>
                                        </li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600"data-translate="bacPage.Année du Bac"></span>
                                            <?php echo $anneeBac; ?>
                                        </li>
                                        <li class="display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600"data-translate="bacPage.Note Bac"></span>
                                            <?php echo $noteBac; ?>
                                        </li>
                                    </ul>
                                    <?php if($ModifierInfosPersonnelles){?>
                                    <button type="button" class="btn btn-primary d-block d-lg-inline-block"
                                        data-bs-toggle="modal" data-bs-target="#modalBac"
                                        data-translate="bacPage.Modifier les informations du Bac">
                                    </button>
                                    <?php }?>

                                    <div class="modal fade" id="modalBac" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"
                                                        data-translate="bacPage.Modifier les informations du Bac"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="../XmlOperations/modifyBacInfos.php"
                                                        enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="anneeBac" class="form-label" data-translate="bacPage.Année du Bac"></label>
                                                            <select id="anneeBac" name="anneeBac">
                                                                <option value="" selected disabled>
                                                                    <?php echo $anneeBac; ?>
                                                                </option>
                                                                <?php
                                                                $currentYear = date('Y');
                                                                for ($i = $currentYear; $i >= $currentYear - 9; $i--) {
                                                                    $nextYear = $i + 1;
                                                                    echo "<option value='$i-$nextYear'>$i-$nextYear</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="noteBac" class="form-label"data-translate="bacPage.Note Bac"></label>
                                                            <input type="number" class="form-control" id="noteBac"
                                                                name="noteBac" value="<?php echo $noteBac; ?>"
                                                                max="20">
                                                        </div>
                                                        <div class="bac-details mt-3">
                                                            <div class="input-group">
                                                                <?php
                                                                $xml = new DOMDocument();
                                                                $xml->load('../xml/baseXml.xml');
                                                                $xpath = new DOMXPath($xml);
                                                                $academies = $xpath->query('//Accademie');
                                                                ?>
                                                                <label for="academieBac1"
                                                                    data-translate="Académie :">Académie :</label>
                                                                <select name="academieBac" id="academieBac">
                                                                    <option value="">
                                                                        <?php echo $academie; ?>
                                                                    </option>
                                                                    <?php foreach ($academies as $academie): ?>
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
                                                                <label for="typeBac"
                                                                    data-translate="Type de Bac :">Type
                                                                    de
                                                                    Bac :</label>
                                                                <select name="typeBac" id="typeBac">
                                                                    <option value="">
                                                                        <?php echo $typeBac; ?>
                                                                    </option>
                                                                    <?php foreach ($typesBac as $typeBac): ?>
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
                                                                <label for="mention1"
                                                                    data-translate="Mention :">Mention
                                                                    :</label>
                                                                <select name="mentionBac" id="mention1">
                                                                    <option value="">
                                                                        <?php echo $mentionBac; ?>
                                                                    </option>
                                                                    <?php foreach ($mentions as $mention): ?>
                                                                    <option value="<?php echo $mention->getAttribute('idMention'); ?>">
                                                                        <?php echo $mention->nodeValue; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="photoProfil"
                                                                    class="form-label" data-translate="diplomePage.Baccalaureat"></label>
                                                                <input type="file" class="form-control"
                                                                    id="photoProfil" name="bac">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"data-translate="candidaturePage.Modification.Fermer"></button>
                                                            <button type="submit"
                                                                class="btn btn-primary"data-translate="candidaturePage.Modification.Enregistrer les changements"></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            overflow: hidden;
            border: 2px solid #000;
            margin-left: 180px;
        }

        @media (max-width: 767px) {
            .profile-pic {
                width: 150px;
                height: 150px;
                margin-left: 50px;
                margin-right: 50px;
            }
        }

        @media (min-width: 768px) {
            .profile-pic {
                width: 200px;
                height: 200px;
                margin-left: 100px;
                margin-right: 100px;
            }
        }

        @media (min-width: 1200px) {
            .profile-pic {
                width: 250px;
           
                height: 250px;
       
                margin-left: 150px;
                margin-right: 150px;

            }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script src="../Translation/languageConncet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
