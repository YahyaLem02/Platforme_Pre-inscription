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
</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <?php
    $xmlFile = '../xml/BaseXml.xml'; 
    
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    
    $xpath = new DOMXPath($xml);
    
    $candidat = $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']")->item(0);
    
    $experiencePro = $xpath->query('experienceProfisonnelle', $candidat)->item(0);
    
    if ($experiencePro !== null) {
        $experience = $xpath->query('experiencePro', $experiencePro)->item(0)->nodeValue;
        $nombreAnnees = $xpath->query('nombreAnne', $experiencePro)->item(0)->nodeValue;
    } else {
        $erreur = 'Aucune expérience professionnelle trouvée pour ce candidat.';
    }
    ?>
    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card border-0">
                        <div class="card-body p-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">

                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th data-translate="experiencePage.Expérience"></th>
                                                    <th data-translate="experiencePage.Nombre d'années"></th>
                                                    <th data-translate="experiencePage.Actions"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($experiencePro !== null) : ?>
                                                <tr>
                                                    <td><?php echo $xpath->query('experiencePro', $experiencePro)->item(0)->nodeValue; ?></td>
                                                    <td><?php echo $xpath->query('nombreAnne', $experiencePro)->item(0)->nodeValue; ?></td>
                                                    <td>
                                                        <?php if($ModifierInfosPersonnelles){?>
                                                        <button type="button"
                                                            class="btn btn-primary d-block d-lg-inline-block"
                                                            data-bs-toggle="modal" data-bs-target="#experienceModal"
                                                            data-translate="experiencePage.Modifier les informations">
                                                        </button>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php else : ?>
                                                <tr>
                                                    <td colspan="2"
                                                        data-translate="experiencePage.Aucune expérience professionnelle disponible">
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="experienceModalLabel"data-translate="experiencePage.Modifier l'expérience professionnelle">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../XmlOperations/modifyExperiencePro.php">
                        <div class="mb-3">
                            <label for="expDetail"
                                class="form-label"data-translate="experiencePage.Détails de l'expérience"></label>
                            <textarea class="form-control" id="expDetail" name="expDetail"><?php echo $xpath->query('experiencePro', $experiencePro)->item(0)->nodeValue; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="expYears" class="form-label"
                                data-translate="experiencePage.Nombre d'années"></label>
                            <input type="text" class="form-control" id="expYears" name="expYears"
                                value="<?php echo $xpath->query('nombreAnne', $experiencePro)->item(0)->nodeValue; ?>">
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



    <style>
        .profile-pic {
            width: 300px;
            height: 300px;
            border-radius: 50%;
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
