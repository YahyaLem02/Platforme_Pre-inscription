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
    // Charger le fichier XML des candidatures
    $xml = simplexml_load_file('../xml/BaseXml.xml');
    echo $_SESSION['idFiliere'];
    
    // Récupérer les candidats ayant effectué des candidatures ou des choix pour la filière spécifiée
    $etudiantsFiltres = $xml->xpath("//candidat[@Utilisateur = //candidature[choix[@idFiliereSouhaite='" . $_SESSION['idFiliere'] . "']]/@Candidat]");
    
    // Traiter les informations des étudiants filtrés
    foreach ($etudiantsFiltres as $etudiant) {
        $CIN = (string) $etudiant['Utilisateur'];
        $NomComplet = (string) $etudiant->nomComplet;
        $Email = (string) $etudiant->email;
    
        $documents = [];
        foreach ($etudiant->xpath('Document') as $document) {
            $idTypeDocument = (string) $document['idTypeDocument'];
            $file = (string) $document->file;
            $documents[] = ['idTypeDocument' => $idTypeDocument, 'file' => $file];
        }
    
        // Récupérer les informations de la candidature associée à ce candidat
        $candidatureAssocie = $xml->xpath("//candidature[@Candidat='$CIN']")[0];
        $StatusCandidature = (string) $candidatureAssocie->status;
        $AnneeCandidature = (string) $candidatureAssocie->AnnneCandidature;
    
        // Récupérer les choix de filière pour cette candidature
        $choixFiliere = [];
        foreach ($candidatureAssocie->xpath("choix[@idFiliereSouhaite='" . $_SESSION['idFiliere'] . "']") as $choix) {
            $ordre = (string) $choix->ordre;
            $choixFiliere[] = ['idFiliereSouhaite' => $_SESSION['idFiliere'], 'ordre' => $ordre];
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
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>CIN</th>
                                                    <th>Nom Complet</th>
                                                    <th>Email</th>
                                                    <th>Status Candidature</th>
                                                    <th>Année Candidature</th>
                                                    <th>Choix de Filière</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($etudiantsFiltres as $etudiant) : ?>
                                                <tr>
                                                    <td><?= $CIN ?></td>
                                                    <td><?= $NomComplet ?></td>
                                                    <td><?= $Email ?></td>
                                                    <td><?= $StatusCandidature ?></td>
                                                    <td><?= $AnneeCandidature ?></td>
                                                    <td>
                                                        <?php foreach ($choixFiliere as $choix) : ?>
                                                        <?= $choix['idFiliereSouhaite'] ?> (Ordre
                                                        <?= $choix['ordre'] ?>)<br>
                                                        <?php endforeach; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
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
