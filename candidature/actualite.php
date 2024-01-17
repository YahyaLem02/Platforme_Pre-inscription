<?php
include '../Translation/headerTranslationCandidatConnect.php';
include_once  '../XmlOperations/Permissions.php';
canAccessPage($isCandidat);
redirectIfNotAuthorized($VoirActualites);
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

<style>
    .actualite-box {
        border: 1px solid #ddd;
        margin: 10px;
        padding: 15px;
        transition: transform 0.3s;
    }

    #actualites-container {
        padding-top: 80px;
        width: 100%;
        align-items: center;
        justify-content: center;
    }

    .actualite-box:hover {
        transform: scale(1.05);
    }

    .actualite-image {
        max-width: 100%;
        max-height: 50px;
        height: 100%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .actualite-details {
        text-align: center;
    }

    .actualite-details h4 {
        margin-bottom: 10px;
    }

    .author-info {
        font-size: 14px;
        margin-bottom: 10px;
    }

</style>

<body>
    <?php include '../Layouts/header.php'; ?>
    <div class="bg-light">
        <div class="container" id="Cont">
            <div class="row" id="actualites-container">
                <h1 class="text-center mb-4" id="actualites-title" data-translate="headerCandidat.Actualités"></h1>

                <?php
                $xml = new DOMDocument();
                $xml->load('../Xml/BaseXml.xml');
                $xpath = new DOMXPath($xml);
                $actualites = $xpath->query('//Actualite');

                if ($actualites->length == 0) {
                    echo '<div class="col-12">Aucune actualité trouvée.</div>';
                } else {
                    foreach ($actualites as $actualite) {
                        $titre = $actualite->getElementsByTagName('Titre')->item(0)->textContent;
                        $description = $actualite->getElementsByTagName('Description')->item(0)->textContent;
                        $image = $actualite->getElementsByTagName('Image')->item(0)->textContent;
                        $idUser = $actualite->getAttribute('idChef');
                        $userNode = $xpath->query("//Utilisateur[@CIN='{$idUser}']")->item(0);
                        $nomComplet = $userNode->getElementsByTagName('nomComplet')->item(0)->textContent;
                        $dep = $userNode->getAttribute('Dep');
                        $NomDep = $xpath->query("//Departement[@sigle='{$dep}']/Nom")->item(0)->textContent;
                        ?>
                <div class="col-md-6 col-lg-3 actualite-box">
                    <div class="actualite-details">
                        <h4><?= $titre ?></h4>
                        <p class="author-info">
                            Par: <?= $nomComplet ?>, chef de département <?= $NomDep ?>
                        </p>
                        <button class="btn btn-primary"
                            onclick="afficherModal('<?= $description ?>', '<?= $image ?>', '<?= $titre ?>', '<?= $nomComplet ?>', '<?= $NomDep ?>')"data-translate="actualitePage.Voir plus"></button>
                    </div>
                </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Modal pour afficher la description -->
        <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog"
            aria-labelledby="descriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalLabel"
                            data-translate="actualitePage.Description de l'Actualité"></h5>

                    </div>
                    <div class="modal-body">
                        <img src="" alt="Actualité Image" id="modalImage" class="img-fluid mb-3">
                        <h4 id="modalTitle"></h4>
                        <p id="modalDescription"></p>
                        <p id="modalSignature" class="text-muted"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"data-translate="candidaturePage.Modification.Fermer"></button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <?php include '../Layouts/footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/language.js"></script>
    <script src="../assets/js/inscrire.js"></script>
    <script src="../assets/js/formInsert.js"></script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/languageConncet.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <script>
        function afficherModal(description, image, titre, nomComplet, nomDep) {
            document.getElementById('modalImage').src = image;
            document.getElementById('modalTitle').innerText = titre;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('modalSignature').innerText = `Par ${nomComplet}, chef de département ${nomDep}`;

            $('#descriptionModal').modal('show');
        }
    </script>
    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>
