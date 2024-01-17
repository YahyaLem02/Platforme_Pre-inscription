<?php
include '../Translation/headerTranslationCandidatConnect.php';
include '../XmlOperations/Permissions.php';
canAccessPage($isRoot);
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
                                    data-target="#insertUserModal"
                                    data-translate="gestionUtilisateurs.Ajouter Utilisateur">
                                </button>
                            </div>
                            <div class="row align-items-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th data-translate="gestionUtilisateurs.Numero de CIN"></th>
                                            <th data-translate="gestionUtilisateurs.Nom Complet"></th>
                                            <th data-translate="gestionUtilisateurs.Login"></th>
                                            <th data-translate="gestionUtilisateurs.Profil"></th>
                                            <th data-translate="gestionUtilisateurs.Departement"></th>
                                            <th data-translate="gestionUtilisateurs.Actions"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $xmlUtilisateurs = simplexml_load_file('../xml/BaseXml.xml');
                                            $utilisateurs = $xmlUtilisateurs->xpath("//Utilisateur[@role!='rol1' and @role!='rol3' ]");
                                            $xmlRoles = simplexml_load_file('../xml/BaseXml.xml');
                                            $xmlDepartements = simplexml_load_file('../xml/BaseXml.xml');
                                            foreach ($utilisateurs as $utilisateur) :
                                                $cinUtilisateur = (string)$utilisateur['CIN'];
                                                $nomComplet = (string)$utilisateur->nomComplet;
                                                $login = (string)$utilisateur->login;
                                                $nomComplet = (string)$utilisateur->nomComplet;
                                                $cin = (string)$utilisateur['CIN'];
                                                $login = (string)$utilisateur->login;
                                                $password = (string)$utilisateur->password;
                                                $roleIdRef = (string)$utilisateur['role'];
                                                $role = $xmlRoles->xpath("//Role[@IdRole='$roleIdRef']");
                                                $roleName = (string)$role[0]->role;
                                                $departementName = "";
                                                if ($roleIdRef === "rol2") {
                                                    $departementIdRef = (string)$utilisateur['Dep'];
                                                    $departement = $xmlDepartements->xpath("//Departement[@sigle='$departementIdRef']");
                                                    $departementName = (string)$departement[0]->Nom;
                                                }
                                            ?>
                                        <tr>
                                            <td><?= $cin ?></td>
                                            <td><?= $nomComplet ?></td>
                                            <td><?= $login ?></td>
                                            <td><?= $roleName ?></td>
                                            <td><?= $roleIdRef === 'rol2' ? $departementName : 'Aucun' ?></td>
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modifierUserModal<?= $cinUtilisateur ?>"
                                                    data-translate="gestionUtilisateurs.motModifier">
                                                </button>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#confirmationUserModal"
                                                    data-id="<?= $cinUtilisateur ?>"
                                                    data-translate="gestionUtilisateurs.Suppression.Supprimer">
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modifierUserModal<?= $cinUtilisateur ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="modifierUserModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modifierUserModalLabel"
                                                            data-translate="gestionUtilisateurs.Modifier Utilisateur">
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../XmlOperations/modifyUser.php" method="POST">
                                                            <input type="hidden" name="cinUtilisateurAModifier"
                                                                id="cinUtilisateurAModifier"
                                                                value="<?= $cinUtilisateur ?>">
                                                            <div class="form-group">
                                                                <label for="nomComplet"
                                                                    data-translate="gestionUtilisateurs.Nom Complet"></label>
                                                                <input type="text" class="form-control"
                                                                    id="nomComplet" name="nomComplet" required
                                                                    value="<?= $nomComplet ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="login"
                                                                    data-translate="gestionUtilisateurs.Login"></label>
                                                                <input type="text" class="form-control"
                                                                    id="login" name="login" required
                                                                    value="<?= $login ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password"
                                                                    data-translate="gestionUtilisateurs.Password"></label>
                                                                <input type="password" class="form-control"
                                                                    id="password" name="password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="profil"
                                                                    data-translate="gestionUtilisateurs.Profil"></label>
                                                                <select class="form-control" id="profilMod"
                                                                    name="profil">
                                                                    <option value="rol1">...</option>
                                                                    <option value="rol2"
                                                                        <?= $roleIdRef === 'rol2' ? 'selected' : '' ?>>
                                                                        Chef de Département</option>
                                                                    <option value="rol4"
                                                                        <?= $roleIdRef === 'rol4' ? 'selected' : '' ?>>
                                                                        Agent de Scolarité</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="departementFieldMod"
                                                                style="display: <?= $roleIdRef === 'rol2' ? 'block' : 'none' ?>;">
                                                                <label for="departement"
                                                                    data-translate="gestionUtilisateurs.Departement"></label>
                                                                <select class="form-control" id="departementMod"
                                                                    name="departement">
                                                                    <?php
                                                            $xmlDepartements = simplexml_load_file('../xml/BaseXml.xml');
                                                            $departements = $xmlDepartements->xpath("//Departement");
                                                            foreach ($departements as $departement) :
                                                                $sigle = (string)$departement['sigle'];
                                                                $nom = (string)$departement->Nom;
                                                            ?>
                                                                    <option value="<?= $sigle ?>"
                                                                        <?= $departementIdRef === $sigle ? 'selected' : '' ?>>
                                                                        <?= $nom ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"
                                                                data-translate="gestionUtilisateurs.Confirmer l'Ajout"></button>
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
        <!-- Modal pour ajouter un utilisateur -->
        <div class="modal fade" id="insertUserModal" tabindex="-1" role="dialog"
            aria-labelledby="insertUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertUserModalLabel"
                            data-translate="gestionUtilisateurs.Ajouter Utilisateur"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../XmlOperations/insertUser.php" method="POST">
                            <div class="form-group">
                                <label for="nomComplet" data-translate="gestionUtilisateurs.Nom Complet"></label>
                                <input type="text" class="form-control" id="nomComplet" name="nomComplet"
                                    required placeholder="Taha Lemkharbech">
                            </div>
                            <div class="form-group">
                                <label for="CIN" data-translate="gestionUtilisateurs.Numero de CIN"></label>
                                <input type="text" class="form-control" id="nomComplet" name="CIN" required
                                    placeholder="MD324234">
                            </div>
                            <div class="form-group">
                                <label for="login" data-translate="gestionUtilisateurs.Login"></label>
                                <input type="text" class="form-control" id="login" name="login" required
                                    placeholder="Taha@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" data-translate="gestionUtilisateurs.Password"></label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    placeholder="********">
                            </div>

                            <div class="form-group">
                                <label for="profil" data-translate="gestionUtilisateurs.Profil"></label>
                                <select class="form-control" id="profil" name="profil">
                                    <option value="">...</option>
                                    <option value="rol2">Chef de Département</option>
                                    <option value="rol4">Agent de Scolarité</option>
                                </select>
                            </div>

                            <div class="form-group" id="departementField" style="display: none;">
                                <label for="departement" data-translate="gestionUtilisateurs.Departement"></label>
                                <select class="form-control" id="departement" name="departement">
                                    <option value="">...</option>
                                    <?php
                                    $xmlDepartements = simplexml_load_file('../xml/BaseXml.xml');
                                    $departements = $xmlDepartements->xpath("//Departement");
                                    foreach ($departements as $departement) :
                                        $sigle = (string)$departement['sigle'];
                                        $nom = (string)$departement->Nom;
                                    ?>
                                    <option value="<?= $sigle ?>"><?= $nom ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"
                                data-translate="gestionUtilisateurs.Confirmer l'Ajout"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationUserModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationUserModalLabel"
                            data-translate="gestionUtilisateurs.Suppression.Confirmation"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p data-translate="gestionUtilisateurs.Êtes-vous sûr de vouloir supprimer cet utilisateur"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-translate="gestionUtilisateurs.Suppression.Annuler"></button>
                        <button type="button" class="btn btn-danger confirmUserDeletionBtn"
                            data-translate="gestionUtilisateurs.Suppression.Supprimer"></button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let cinToDelete;

            $('[data-target="#confirmationUserModal"]').on('click', function() {
                cinToDelete = $(this).data('id');
            });

            $('.confirmUserDeletionBtn').click(function() {
                window.location.href = '../XmlOperations/deleteUser.php?cinToDelete=' + cinToDelete;
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
                                                                                                                                                                                                                swal('Erreur', '$messageError', 'error');                                                                                                                                                });
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-Gn5384xqQ1aoEXyAiq6jJ6pDI4y25G2PhUPKsHIJ4lM=" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyAqXMlq5Q9g8xvBpd6P9jO5FoBIf5It5" crossorigin="anonymous"></script>
    <script>
        var profilField = document.getElementById('profil');
        var departementField = document.getElementById('departementField');
        var departementSelect = document.getElementById('departement');
        profilField.addEventListener('change', function() {
            if (this.value === 'rol2') {
                departementField.style.display = 'block';
            } else {
                departementField.style.display = 'none';
                departementSelect.selectedIndex = 0;
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-Gn5384xqQ1aoEXyAiq6jJ6pDI4y25G2PhUPKsHIJ4lM=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyAqXMlq5Q9g8xvBpd6P9jO5FoBIf5It5" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            var profilFieldMod = $('#profilMod');
            var departementFieldMod = $('#departementFieldMod');
            var departementSelectMod = $('#departementMod');
            departementFieldMod.toggle(profilFieldMod.val() === 'rol2');
            profilFieldMod.on('change', function() {
                departementFieldMod.toggle(this.value === 'rol2');
                if (this.value !== 'rol2') {
                    departementSelectMod.val('');
                }
            });
        });
    </script>
</body>

</html>
