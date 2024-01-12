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
</head>

<body>
    <?php include '../Layouts/header.php'; ?>

    <?php
    $xml = simplexml_load_file('../xml/BaseXml.xml');
    $etudiantsFiltres = $xml->xpath("//candidat[@Utilisateur = //candidature[choix[@idFiliereSouhaite='" . $_SESSION['idFiliere'] . "']]/@Candidat]");
    foreach ($etudiantsFiltres as $etudiant) {
        $CIN = (string) $etudiant['Utilisateur'];
        $candidatureAssocie = $xml->xpath("//candidature[@Candidat='$CIN']")[0];
        $StatusCandidature = (string) $candidatureAssocie->status;
        $AnneeCandidature = (string) $candidatureAssocie->AnnneCandidature;
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
                                                    <th>Photo</th>
                                                    <th>CIN</th>
                                                    <th>Nom Complet</th>
                                                    <th>Email</th>
                                                    <th>Addresse</th>
                                                    <th>Status Candidature</th>
                                                    <th>Année Candidature</th>
                                                    <th>Ordre de choix</th>
                                                    <th>Infos bac </th>
                                                    <th>Infos diplome </th>
                                                    <th>Experience Pro</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($etudiantsFiltres as $etudiant): ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?= $etudiant->Document[4]->file ?>" target="_blank">
                                                            <img height="60"
                                                                src="<?= $etudiant->Document[4]->file ?>"
                                                                alt="">
                                                        </a>
                                                    </td>
                                                    <td><?= (string) $etudiant['Utilisateur'] ?></td>
                                                    <td><?= (string) $etudiant->nomComplet ?></td>
                                                    <td><?= (string) $etudiant->email ?></td>
                                                    <td><?php echo  (string) $etudiant->addresse1.'/'.(string) $etudiant->addresse2;  ?></td>
                                                    <td><?= (string) $candidatureAssocie->status ?></td>
                                                    <td><?= (string) $candidatureAssocie->AnnneCandidature ?></td>
                                                    <td>
                                                        <?php
                                                        $candidatureAssocie = $xml->xpath("//candidature[@Candidat='" . $etudiant['Utilisateur'] . "']")[0];
                                                        $choixFiliere = [];
                                                        foreach ($candidatureAssocie->xpath("choix[@idFiliereSouhaite='" . $_SESSION['idFiliere'] . "']") as $choix):
                                                        ?>
                                                        <?= $choix->ordre ?><br>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <i class="bi bi-eye text-primary" style="cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal<?= $etudiant['Utilisateur'] ?>"></i>
                                                        <div class="modal fade"
                                                            id="modal<?= $etudiant['Utilisateur'] ?>" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Détails du Candidat</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="info-candidat">
                                                                            <div class="bac-info">
                                                                                <p><strong>Mention Bac:</strong>
                                                                                    <?php ?>
                                                                                    <?= (string) $etudiant->bac['mentionBac'] ?>
                                                                                </p>
                                                                                <?php // Supposons que $etudiant->bac['type'] contient l'idType
                                                                                $idTypeBac = (string) $etudiant->bac['type'];
                                                                                
                                                                                // Utilisez XPath pour localiser le bon TypeBac en fonction de l'idType
                                                                                $typeBac = $xml->xpath("//TypeBac[@idType='$idTypeBac']")[0];
                                                                                
                                                                                $nomTypeBac = (string) $typeBac->nomType;
                                                                                ?>
                                                                                <p><strong>Type Bac:</strong>
                                                                                    <?= $nomTypeBac ?></p>
                                                                                <?php // Supposons que $etudiant->bac['accadime'] contient l'idAcademie
                                                                                $idAcademie = (string) $etudiant->bac['accadime'];
                                                                                $academie = $xml->xpath("//Accademie[@idAcademie='$idAcademie']")[0];
                                                                                $nomAcademie = (string) $academie->nomAcademie;
                                                                                ?>
                                                                                <p><strong>Académie:</strong>
                                                                                    <?= $nomAcademie ?></p>
                                                                                </p>
                                                                                <p><strong>Année du Bac:</strong>
                                                                                    <?= (string) $etudiant->bac->anneeBac ?>
                                                                                </p>
                                                                                <p><strong>Note du Bac:</strong>
                                                                                    <?= (string) $etudiant->bac->noteBac ?>
                                                                                </p>
                                                                                <p><strong>Copie du Bac:</strong>
                                                                                    <a
                                                                                        href="<?= $etudiant->Document[0]->file ?>">Voir
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <i class="bi bi-eye text-primary" style="cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDiplome<?= $etudiant['Utilisateur'] ?>"></i>
                                                        <div class="modal fade"
                                                            id="modalDiplome<?= $etudiant['Utilisateur'] ?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Détails du Diplôme</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table
                                                                            class="table table-bordered table-striped">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Mention Diplôme:
                                                                                    </th>
                                                                                    <td><?= (string) $etudiant->Diplome['mentionDiplome'] ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Etablissement:
                                                                                    </th>
                                                                                    <?php
                                                                                    $etablissementId = (string) $etudiant->Diplome['Etablissement'];
                                                                                    $etablissements = $xml->xpath("//Etablissement[@idEtablissement='$etablissementId']/nomEtablissement");
                                                                                    
                                                                                    if (empty($etablissements)) {
                                                                                        $etablissements = $xml->xpath("//centre[@idCentre='$etablissementId']/NomCentre");
                                                                                    }
                                                                                    
                                                                                    if (!empty($etablissements)) {
                                                                                        $nomEtablissement = (string) $etablissements[0];
                                                                                    } else {
                                                                                        $nomEtablissement = 'Établissement non trouvé';
                                                                                    }
                                                                                    ?>

                                                                                    <td><?= $nomEtablissement ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    $idFormation = (string) $etudiant->Diplome['typeFormation'];
                                                                                    $formations = $xml->xpath("//TypeFormation[@idFormation='$idFormation']/NomFormation");
                                                                                    
                                                                                    if (!empty($formations)) {
                                                                                        $nomFormation = (string) $formations[0];
                                                                                    } else {
                                                                                        $nomFormation = 'Formation non trouvée';
                                                                                    }
                                                                                    ?>
                                                                                    <th scope="row">Type de
                                                                                        Formation:</th>
                                                                                    <td><?= $nomFormation ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Informations de
                                                                                        la Première Année:</th>
                                                                                    <td>
                                                                                        <strong>Année:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsPremiereAnnee->annee ?><br>
                                                                                        <strong>Nombre
                                                                                            d'Étudiants:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsPremiereAnnee->NombreEtudiant ?><br>
                                                                                        <strong>Moyenne:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsPremiereAnnee->moyenne ?><br>
                                                                                        <strong>Classement:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsPremiereAnnee->classement ?><br>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Informations de
                                                                                        la Deuxième Année:</th>
                                                                                    <td>
                                                                                        <strong>Année:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsDeuxiemeAnnee->annee ?><br>
                                                                                        <strong>Nombre
                                                                                            d'Étudiants:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsDeuxiemeAnnee->NombreEtudiant ?><br>
                                                                                        <strong>Moyenne:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsDeuxiemeAnnee->moyenne ?><br>
                                                                                        <strong>Classement:</strong>
                                                                                        <?= (string) $etudiant->Diplome->InofsDeuxiemeAnnee->classement ?><br>

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Documents:</th>
                                                                                    <td>
                                                                                        <strong>Diplome:</strong> <a
                                                                                            href="<?= $etudiant->Document[1]->file ?>">Voir
                                                                                        </a><br>
                                                                                        <strong>le relevé de notes
                                                                                            première année</strong> <a
                                                                                            href="<?= $etudiant->Document[3]->file ?>">Voir</a><br>
                                                                                        <strong>le relevé de notes
                                                                                            deuxième année:</strong> <a
                                                                                            href="<?= $etudiant->Document[4]->file ?>">Voir
                                                                                        </a><br>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <i class="bi bi-eye text-primary" style="cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalExperience<?= $etudiant['Utilisateur'] ?>"></i>
                                                        <div class="modal fade"
                                                            id="modalExperience<?= $etudiant['Utilisateur'] ?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">Détails de
                                                                            l'Expérience Professionnelle</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <?php if (isset($etudiant->experienceProfisonnelle->experiencePro) || isset($etudiant->experienceProfisonnelle->nombreAnne)): ?>
                                                                        <?php if (isset($etudiant->experienceProfisonnelle->experiencePro)): ?>
                                                                        <div class="mb-3">
                                                                            <h6>Expérience Professionnelle:</h6>
                                                                            <p><?= (string) $etudiant->experienceProfisonnelle->experiencePro ?>
                                                                            </p>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <?php if (isset($etudiant->experienceProfisonnelle->nombreAnne)): ?>
                                                                        <div class="mb-3">
                                                                            <h6>Nombre d'Années:</h6>
                                                                            <p><?= (string) $etudiant->experienceProfisonnelle->nombreAnne ?>
                                                                            </p>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <?php else: ?>
                                                                        <div class="mb-3">
                                                                            <p>Aucune expérience professionnelle.</p>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
