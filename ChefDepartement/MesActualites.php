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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#insertModal">
                                    Ajouter Actualité
                                </button>
                            </div>
                            <div class="row align-items-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $xml = simplexml_load_file('../xml/BaseXml.xml');
                                        $actualites = $xml->xpath("//Actualite[@idChef='" . $_SESSION['cin'] . "']");
                                        foreach ($actualites as $actualite) :
                                            $idActualite = (string)$actualite['idActualite'];
                                            $idChef = (string)$actualite['idChef'];
                                            $Titre = (string)$actualite->Titre;
                                            $description = (string)$actualite->Description;
                                            $image = (string)$actualite->Image;
                                        ?>
                                        <tr>
                                            <td><?= $Titre ?></td>
                                            <td><?= $description ?></td>
                                            <td>
                                                <button type="button" class="btn btn-link" data-toggle="modal"
                                                    data-target="#imageModal<?= $idActualite ?>">
                                                    <i class="fas fa-eye">Voir</i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#confirmationModal" data-id="<?= $idActualite ?>">
                                                    Supprimer
                                                </button>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modifierActualiteModal<?= $idActualite ?>">
                                                    Modifier
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="imageModal<?= $idActualite ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?= $image ?>" class="img-fluid" alt="Image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal pour modifier l'actualité -->
                                        <div class="modal fade" id="modifierActualiteModal<?= $idActualite ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="modifierActualiteModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modifierActualiteModalLabel">
                                                            Modifier Actualité</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Formulaire pour modifier l'actualité -->
                                                        <form id="modifierActualiteForm"
                                                            action="../XmlOperations/modifyActualite.php" method="post"
                                                            enctype="multipart/form-data">
                                                            <!-- Champ caché pour l'ID de l'actualité à modifier -->
                                                            <input type="hidden" name="idActualiteAModifier"
                                                                id="idActualiteAModifier" value="<?= $idActualite ?>">
                                                            <!-- Champ d'entrée pour le titre -->
                                                            <div class="form-group">
                                                                <label for="titreModifier">Titre :</label>
                                                                <input type="text" class="form-control"
                                                                    id="titreModifier" name="titre" required
                                                                    value="<?= $Titre ?>">
                                                            </div>
                                                            <!-- Champ d'entrée pour la description -->
                                                            <div class="form-group">
                                                                <label for="descriptionModifier">Description :</label>
                                                                <textarea class="form-control" id="descriptionModifier" name="description" rows="3" required><?= $description ?></textarea>
                                                            </div>
                                                            <!-- Champ d'entrée pour l'image -->
                                                            <div class="form-group">
                                                                <label for="imageModifier">Image :</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="imageModifier" name="image"
                                                                    accept="image/*">
                                                            </div>
                                                            <!-- Bouton de confirmation -->
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary">Confirmer la
                                                                Modification</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertModalLabel">Ajouter Actualité</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire d'insertion -->
                        <form action="../XmlOperations/insertActualite.php" method="POST"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="titre">Titre :</label>
                                <input type="text" class="form-control" id="titre" name="titre" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" class="form-control-file" id="image" name="image"
                                    accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer cette actualité ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" id="confirmDeletion">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                let actualiteIdToDelete;
                $('#confirmationModal').on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget);
                    actualiteIdToDelete = button.data('id');
                });
                $('#confirmDeletion').click(function() {
                    window.location.href = '../XmlOperations/deleteActualite.php?idActualite=' +
                        actualiteIdToDelete;
                });
            });
        </script>

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