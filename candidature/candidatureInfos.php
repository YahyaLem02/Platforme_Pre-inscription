<?php
include '../Translation/headerTranslationCandidatConnect.php';
?>
<?php
// Charger le fichier XML
$xmlFile = '../xml/BaseXml.xml'; // Chemin vers le fichier XML

// Charger le fichier XML en tant qu'objet DOMDocument
$xml = new DOMDocument();
$xml->load($xmlFile);

// Créer un objet DOMXPath
$xpath = new DOMXPath($xml);

// Utiliser XPath pour récupérer la candidature du candidat spécifique
$candidature = $xpath->query("//candidature[@Candidat='{$_SESSION['cin']}']")->item(0);

// Initialiser des variables par défaut
$candidatureData = [];
$erreurCandidature = '';

// Vérifier s'il y a une candidature pour ce candidat
if ($candidature !== null) {
    $status = $xpath->query('status', $candidature)->item(0)->nodeValue;
    $anneeCandidature = $xpath->query('AnnneCandidature', $candidature)->item(0)->nodeValue;

    $choixList = $xpath->query('choix', $candidature);
    $choix = [];
    foreach ($choixList as $choixItem) {
        $idFiliere = $choixItem->getAttribute('idFiliereSouhaite');
        $ordre = $xpath->query('ordre', $choixItem)->item(0)->nodeValue;
        $choix[] = ['idFiliere' => $idFiliere, 'ordre' => $ordre];
    }

    $candidatureData = [
        'status' => $status,
        'anneeCandidature' => $anneeCandidature,
        'choix' => $choix,
    ];
} else {
    $erreurCandidature = 'Aucune candidature trouvée pour ce candidat.';
}

// Obtention des informations sur les filières disponibles
$filiereList = [];
$fileres = $xpath->query('//FiliereSouhaite');
foreach ($fileres as $filiere) {
    $idFiliere = $filiere->getAttribute('idFiliere');
    $intituleFiliere = $xpath->query('intituleFiliere', $filiere)->item(0)->nodeValue;
    $filiereList[$idFiliere] = $intituleFiliere;
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
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../Layouts/header.php'; ?>
    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card border-0">
                        <div class="card-body p-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <?php if (!empty($candidatureData)) : ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Année de candidature</th>
                                                    <th>Choix</th>
                                                    <th>Filière</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($candidatureData['choix'] as $key => $choix) : ?>
                                                <tr>
                                                    <?php if ($key === 0) : ?>
                                                    <td rowspan="<?php echo count($candidatureData['choix']); ?>"><?php echo $candidatureData['status']; ?></td>
                                                    <td rowspan="<?php echo count($candidatureData['choix']); ?>"><?php echo $candidatureData['anneeCandidature']; ?></td>
                                                    <?php endif; ?>
                                                    <td>Ordre: <?php echo $choix['ordre']; ?></td>
                                                    <td><?php echo $choix['idFiliere']; ?></td>
                                                    <td><?php echo isset($filiereList[$choix['idFiliere']]) ? $filiereList[$choix['idFiliere']] : 'Non trouvé'; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php else : ?>
                                    <p><?php echo isset($erreurCandidature) ? $erreurCandidature : 'Aucune candidature trouvée pour ce candidat.'; ?></p>
                                    <?php endif; ?>
                                    <!-- Bouton de modification -->
                                    <?php if (!empty($candidatureData)) : ?>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-type="modification">
                                        Modifier votre candidature
                                    </button>
                                    <!-- Modal de modification -->
                                    <?php endif  ?>
                                    <?php if (empty($candidatureData)) : ?>
                                    <!-- Afficher le bouton d'ajout de candidature si aucune candidature n'existe -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-type="ajout">
                                        Ajouter candidature
                                    </button>
                                    <?php endif; ?>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Titre du modal</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire pour l'ajout ou la modification -->
                                                    <form method="post" action="" id="modalForm">
                                                        <div class="mb-3">
                                                            <label for="choixFiliere1" class="form-label">Choisissez
                                                                une
                                                                filière :</label>
                                                            <select name="choixFiliere1" id="choixFiliere1"
                                                                class="form-select choixFiliere">
                                                                <option value=""
                                                                    data-translate="Choisissez une option">Choisissez
                                                                    une
                                                                    option</option>
                                                                <?php
                                                                $xmlFile = '../xml/BaseXml.xml';
                                                                $xml = simplexml_load_file($xmlFile);
                                                                if ($xml !== false) {
                                                                    $candidat = $xml->xpath("//candidat[@Utilisateur='" . $_SESSION['cin'] . "']/Diplome/@filiereDiplome");
                                                                    if (!empty($candidat)) {
                                                                        $idFS = (string) $candidat[0];
                                                                        $filiereSouhaite = $xml->xpath("//FiliereDiplome[@idFiliere='$idFS']/@filliereSouhaitee");
                                                                        if (!empty($filiereSouhaite)) {
                                                                            $filiereSouhaite = (string) $filiereSouhaite[0];
                                                                            $filiereSouhaiteList = $xml->xpath("//FiliereSouhaite[@lang='" . $_SESSION['lang'] . "' and @idFiliere='$filiereSouhaite']");
                                                                
                                                                            if (!empty($filiereSouhaiteList)) {
                                                                                foreach ($filiereSouhaiteList as $filiere) {
                                                                                    $idFiliere = (string) $filiere['idFiliere'];
                                                                                    $intituleFiliere = (string) $filiere->intituleFiliere;
                                                                                    echo '<option value="' . $idFiliere . '">' . $intituleFiliere . '</option>';
                                                                                }
                                                                            } else {
                                                                                echo '<option value="">Aucune filière trouvée</option>';
                                                                            }
                                                                        } else {
                                                                            echo '<option value="">Filière souhaitée non trouvée</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="">Filière du candidat non trouvée</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Impossible de charger le fichier XML</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                        <!-- Menu déroulant 2 -->
                                                        <div class="mb-3">
                                                            <label for="choixFiliere2" class="form-label">Choix 2
                                                                :</label>
                                                            <select name="choixFiliere2" id="choixFiliere2"
                                                                class="form-select choixFiliere">
                                                                <option value=""
                                                                    data-translate="Choisissez une option">Choisissez
                                                                    une
                                                                    option</option>
                                                                <?php
                                                                $xmlFile = '../xml/BaseXml.xml';
                                                                $xml = simplexml_load_file($xmlFile);
                                                                if ($xml !== false) {
                                                                    $filiereSouhaiteList = $xml->xpath("//FiliereSouhaite[@lang='" . $_SESSION['lang'] . "']");
                                                                    if (!empty($filiereSouhaiteList)) {
                                                                        foreach ($filiereSouhaiteList as $filiere) {
                                                                            $idFiliere = (string) $filiere['idFiliere'];
                                                                            $intituleFiliere = (string) $filiere->intituleFiliere;
                                                                            echo '<option value="' . $idFiliere . '">' . $intituleFiliere . '</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="">Aucune filière trouvée</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Impossible de charger le fichier XML</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                        <!-- Menu déroulant 3 -->
                                                        <div class="mb-3">
                                                            <label for="choixFiliere3" class="form-label">Choix 3
                                                                :</label>
                                                            <select name="choixFiliere3" id="choixFiliere3"
                                                                class="form-select choixFiliere">
                                                                <option value=""
                                                                    data-translate="Choisissez une option">Choisissez
                                                                    une
                                                                    option</option>
                                                                <?php
                                                                $xmlFile = '../xml/BaseXml.xml';
                                                                $xml = simplexml_load_file($xmlFile);
                                                                
                                                                if ($xml !== false) {
                                                                    $filiereSouhaiteList = $xml->xpath("//FiliereSouhaite[@lang='french']");
                                                                
                                                                    if (!empty($filiereSouhaiteList)) {
                                                                        foreach ($filiereSouhaiteList as $filiere) {
                                                                            $idFiliere = (string) $filiere['idFiliere'];
                                                                            $intituleFiliere = (string) $filiere->intituleFiliere;
                                                                            echo '<option value="' . $idFiliere . '">' . $intituleFiliere . '</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="">Aucune filière trouvée</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Impossible de charger le fichier XML</option>';
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                </div>
                                                </form>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <!-- Bouton pour soumettre le formulaire -->
                                                <button type="submit" class="btn btn-primary"
                                                    id="submitBtn">Enregistrer les changements</button>
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
    </div>



    <?php include '../Layouts/footer.html'; ?>


    <!-- Votre HTML existant -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get references to the dropdown menus
            var choixFiliere1 = $('#choixFiliere1');
            var choixFiliere2 = $('#choixFiliere2');
            var choixFiliere3 = $('#choixFiliere3');

            // Event handler for changing the first dropdown menu (#choixFiliere1)
            choixFiliere1.on('change', function() {
                // Get the selected option value
                var selectedOption = $(this).val();

                // Reset the second dropdown menu (#choixFiliere2)
                choixFiliere2.val('');
                choixFiliere2.find('option').removeAttr('disabled');

                // Disable the selected option in the second dropdown menu
                if (selectedOption !== '') {
                    choixFiliere2.find('option[value="' + selectedOption + '"]').attr('disabled',
                        'disabled');
                }
            });

            // Event handler for changing the second dropdown menu (#choixFiliere2)
            choixFiliere2.on('change', function() {
                // Get the selected option value
                var selectedOption = $(this).val();

                // Reset the third dropdown menu (#choixFiliere3)
                choixFiliere3.val('');
                choixFiliere3.find('option').removeAttr('disabled');

                // Disable the selected options in the third dropdown menu
                if (selectedOption !== '') {
                    choixFiliere3.find('option[value="' + selectedOption + '"]').attr('disabled',
                        'disabled');
                }

                // Disable the options selected in the first dropdown menu (#choixFiliere1)
                var selectedOption1 = choixFiliere1.val();
                if (selectedOption1 !== '') {
                    choixFiliere3.find('option[value="' + selectedOption1 + '"]').attr('disabled',
                        'disabled');
                }
            });
        });
    </script>



    <!-- Votre HTML existant -->

    <script>
        var modalTriggerButtons = document.querySelectorAll('[data-bs-target="#exampleModal"]');
        modalTriggerButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var type = this.getAttribute('data-type');
                var form = document.getElementById('modalForm');
                var submitBtn = document.getElementById('submitBtn');

                if (type === 'ajout') {
                    form.action = "../XmlOperations/insertCandidature.php";
                } else if (type === 'modification') {
                    form.action = "../XmlOperations/ModifyCandidature.php";
                }

                submitBtn.setAttribute('form', 'modalForm');
            });
        });
    </script>


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
