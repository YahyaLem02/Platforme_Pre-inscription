<?php
include '../Translation/headerTranslationCandidatConnect.php';
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
    // Charger le fichier XML
    $xmlFile = '../xml/BaseXml.xml'; // Mettez ici le chemin de votre fichier XML
    
    // Charger le fichier XML en tant qu'objet DOMDocument
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    
    // Créer un objet DOMXPath
    $xpath = new DOMXPath($xml);
    
    // Utiliser XPath pour récupérer les informations du candidat
    $candidat = $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']")->item(0);
    
    // Récupérer les informations personnelles
    $nomComplet = $xpath->query('nomComplet', $candidat)->item(0)->nodeValue;
    $email = $xpath->query('email', $candidat)->item(0)->nodeValue;
    $addresse1 = $xpath->query('addresse1', $candidat)->item(0)->nodeValue;
    $addresse2 = $xpath->query('addresse2', $candidat)->item(0)->nodeValue;
    $dateNaissance = $xpath->query('dateNaissance', $candidat)->item(0)->nodeValue;
    $lieuNaissance = $xpath->query('lieuNaissance', $candidat)->item(0)->nodeValue;
    
    // Afficher les informations dans le modèle HTML
    
    ?>
    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card border-0">
                        <div class="card-body p-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-3 ">
                                    <div class="profile-pic">
                                        <img src="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='baccalaureat']/file")->item(0)->nodeValue; ?>" alt="<?php echo $xpath->query("//candidat[@Utilisateur='{$_SESSION['cin']}']/Document[@idTypeDocument='photoProfil']/file")->item(0)->nodeValue; ?>" class="img-fluid">
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="../XmlOperations/modifyPersonalInfo.php"
                                                    enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label for="nomComplet" class="form-label">Nom complet</label>
                                                        <input type="text" class="form-control" id="nomComplet"
                                                            name="nomComplet" value="<?php echo $nomComplet; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" value="<?php echo $email; ?>">
                                                    </div>
                                                    <!-- Ajoutez d'autres champs pour les informations restantes -->
                                                    <div class="mb-3">
                                                        <label for="adresse1" class="form-label">Adresse 1</label>
                                                        <input type="text" class="form-control" id="adresse1"
                                                            name="adresse1" value="<?php echo $addresse1; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adresse2" class="form-label">Adresse 2</label>
                                                        <input type="text" class="form-control" id="adresse2"
                                                            name="adresse2" value="<?php echo $addresse2; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="dateNaissance" class="form-label">Date de
                                                            naissance</label>
                                                        <input type="date" class="form-control" id="dateNaissance"
                                                            name="dateNaissance" value="<?php echo $dateNaissance; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lieuNaissance" class="form-label">Lieu de
                                                            naissance</label>
                                                        <input type="text" class="form-control" id="lieuNaissance"
                                                            name="lieuNaissance" value="<?php echo $lieuNaissance; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="photoProfil" class="form-label">Photo de
                                                            profil</label>
                                                        <input type="file" class="form-control" id="photoProfil"
                                                            name="photoProfil">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer les
                                                            modifications</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="bg-secondary py-3 px-3 mb-3 rounded">
                                        <h3 class="h2 text-white mb-0"><?php echo $nomComplet; ?></h3>
                                        <!-- Ajoutez ici d'autres détails du candidat -->
                                    </div>
                                    <ul class="list-unstyled mb-1-9">
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Email:</span>
                                            <?php echo $email; ?></li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Adresse:</span>
                                            <?php echo $addresse1 . ', ' . $addresse2; ?></li>
                                        <li class="mb-2 mb-xl-3 display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Date de
                                                Naissance:</span>
                                            <?php echo $dateNaissance; ?></li>
                                        <li class="display-28"><span
                                                class="display-26 text-secondary me-2 font-weight-600">Lieu de
                                                Naissance:</span>
                                            <?php echo $lieuNaissance; ?></li>
                                    </ul>
                                    <button type="button" class="btn btn-primary d-block d-lg-inline-block"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Modifier les informations
                                    </button>
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
            /* ajustez la taille du cercle selon vos besoins */
            height: 300px;
            /* ajustez la taille du cercle selon vos besoins */
            border-radius: 50%;
            /* rend l'image circulaire */
            overflow: hidden;
            /* masque les parties de l'image qui dépassent du cercle */
            border: 2px solid #000;
            margin-left: 180px;
            /* couleur et épaisseur de la bordure */
        }

        @media (max-width: 767px) {
            .profile-pic {
                width: 150px;
                /* Taille pour les écrans plus petits */
                height: 150px;
                /* Taille pour les écrans plus petits */
                margin-left: 50px;
                /* Marge ajustée pour les écrans plus petits */
                margin-right: 50px;
                /* Marge ajustée pour les écrans plus petits */
            }
        }

        /* Pour les tablettes et les ordinateurs de bureau */
        @media (min-width: 768px) {
            .profile-pic {
                width: 200px;
                /* Taille pour les tablettes et les ordinateurs de bureau */
                height: 200px;
                /* Taille pour les tablettes et les ordinateurs de bureau */
                margin-left: 100px;
                /* Marge ajustée pour les tablettes et les ordinateurs de bureau */
                margin-right: 100px;
                /* Marge ajustée pour les tablettes et les ordinateurs de bureau */
            }
        }

        /* Pour les écrans plus larges (par exemple, les grands ordinateurs de bureau) */
        @media (min-width: 1200px) {
            .profile-pic {
                width: 250px;
                /* Taille pour les grands écrans */
                height: 250px;
                /* Taille pour les grands écrans */
                margin-left: 150px;
                /* Marge ajustée pour les grands écrans */
                margin-right: 150px;
                /* Marge ajustée pour les grands écrans */
            }
        }

        .profile-pic img {
            width: 100%;
            /* assurez-vous que l'image remplit le cercle */
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
