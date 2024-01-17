<?php
include '../Translation/headerTranslationCandidatConnect.php';
include '../XmlOperations/Permissions.php';
canAccessPage($isAgentScolarite);
function getUniqueFiliereOptions($xml)
{
    $filieres = [];
    foreach ($xml->xpath("//FiliereSouhaite[@lang='french']/intituleFiliere") as $filiere) {
        $filieres[] = (string) $filiere;
    }
    return array_unique($filieres);
}
function getUniqueAnneeOptions($xml)
{
    $annees = [];
    foreach ($xml->xpath('//AnnneCandidature') as $annee) {
        $annees[] = (string) $annee;
    }
    return array_unique($annees);
}

$xml = simplexml_load_file('../xml/BaseXml.xml');
$etudiantsFiltres = $xml->xpath('//candidat[@Utilisateur = //candidature/@Candidat]');
$uniqueFilieres = getUniqueFiliereOptions($xml);
$uniqueAnnees = getUniqueAnneeOptions($xml);
?>

<!DOCTYPE html>
<html <?php echo $_SESSION['lang'] === 'arabic' ? 'lang="ar" dir="rtl"' : 'lang="fr" dir="ltr"'; ?>>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-candidature</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
    </script>

</head>

<body>
    <?php include '../Layouts/header.php'; ?>

    <div class="bg-light">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="filterFiliere" class="form-label" data-translate="indexAgentScolarite.Filière:"></label>
                    <select id="filterFiliere" class="form-select">
                        <option value="" data-translate="indexAgentScolarite.All"></option>
                        <?php
                        foreach ($uniqueFilieres as $filiere) {
                            echo "<option value='$filiere'>$filiere</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filterAnnee" class="form-label"data-translate="indexAgentScolarite.Année:"></label>
                    <select id="filterAnnee" class="form-select">
                        <option value="" data-translate="indexAgentScolarite.All"></option>
                        <?php
                        foreach ($uniqueAnnees as $annee) {
                            echo "<option value='$annee'>$annee</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th data-translate="indexAgentScolarite.CIN"></th>
                        <th data-translate="indexAgentScolarite.Nom Complet"></th>
                        <th data-translate="indexAgentScolarite.Filière Candidature"></th>
                        <th data-translate="indexAgentScolarite.Annee Candidature"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $xml = simplexml_load_file('../xml/BaseXml.xml');
                    $etudiantsFiltres = $xml->xpath('//candidat[@Utilisateur = //candidature/@Candidat]');
                         foreach ($etudiantsFiltres as $etudiant) {
                        $CIN = (string) $etudiant['Utilisateur'];
                        $candidatureAssocie = $xml->xpath("//candidature[@Candidat='$CIN']")[0];
                        $idFiliereSouhaite = (string) $candidatureAssocie->choix[0]['idFiliereSouhaite'];
                        $AnneeCandidature = (string) $candidatureAssocie->AnnneCandidature;
                        $NomComplet = (string) $etudiant->nomComplet;
                        $intituleFiliere = (string) $xml->xpath("//FiliereSouhaite[@idFiliere='$idFiliereSouhaite']/intituleFiliere")[0];
                    
                        echo '<tr>';
                        echo "<td>{$CIN}</td>";
                        echo "<td>{$NomComplet}</td>";
                        echo "<td>{$intituleFiliere}</td>";
                        echo "<td>{$AnneeCandidature}</td>";
                        echo '</tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php include '../Layouts/footer.html'; ?>
    <?php
    if (isset($_GET['messageSuccess'])) {
        $messageSuccess = urldecode($_GET['messageSuccess']);
        echo "<script src='../node_modules/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    swal('Succès',                   '
                    $messageSuccess', 'success');
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
    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excel',
                    text: 'Export to Excel',
                    className: 'excel-button',
                }],
                pageLength: 10,
            });

            $('#filterFiliere').on('change', function() {
                var filiere = $(this).val();
                table.column(2).search(filiere).draw();
            });

            $('#filterAnnee').on('change', function() {
                var annee = $(this).val();
                table.column(3).search(annee).draw();
            });
        });
    </script>
    <style>
        .dt-buttons .excel-button {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>







</body>

</html>
