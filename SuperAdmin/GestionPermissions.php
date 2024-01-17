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
                        <h1>Gestion des permissions</h1>
                        <div class="card-body p-3 p-md-6 p-lg-7">
                            <table class="table table-bordered">
                                <tbody id="permissionsTableBody">
                                </tbody>
                            </table>
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
    
        fetch('../xml/BaseXml.xml')
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(data, 'text/xml');
                const permissions = xmlDoc.getElementsByTagName('Permission');
                const permissionsByRole = {};
                for (let i = 0; i < permissions.length; i++) {
                    const permission = permissions[i];
                    const role = permission.getAttribute('Role');
                    const idPermission = permission.getAttribute('IdPermission');
                    const state = permission.getAttribute('state');
                    const forText = permission.getElementsByTagName('for')[0].textContent;

                    if (!permissionsByRole[role]) {
                        permissionsByRole[role] = [];
                    }

                    permissionsByRole[role].push({
                        idPermission: idPermission,
                        forText: forText,
                        state: state
                    });
                }
                const tableBody = document.getElementById('permissionsTableBody');
                for (const [role, rolePermissions] of Object.entries(permissionsByRole)) {
                    const roleHeaderRow = document.createElement('tr');
                    const roleHeaderCell = document.createElement('th');
                    roleHeaderCell.setAttribute('colspan', '3');
                    roleHeaderCell.textContent = role === 'rol1' ? 'candidat' : 'Chef departement';
                    roleHeaderRow.appendChild(roleHeaderCell);
                    tableBody.appendChild(roleHeaderRow);
                    for (const permission of rolePermissions) {
                        const row = document.createElement('tr');
                        const permissionCell = document.createElement('td');
                        permissionCell.textContent = permission.forText;
                        row.appendChild(permissionCell);
                        const roleCell = document.createElement('td');
                        row.appendChild(roleCell);
                        const actionCell = document.createElement('td');
                        const actionButton = document.createElement('button');
                        actionButton.textContent = permission.state === '1' ? 'Désactiver' : 'Activer';
                        actionButton.classList.add('btn', permission.state === '1' ? 'btn-danger' : 'btn-success');
                        actionButton.addEventListener('click', () => {
                         modifierEtatPermission(permission.idPermission, permission.state === '1' ? '0' :
                                '1');
                        });
                        actionCell.appendChild(actionButton);
                        row.appendChild(actionCell);
                        tableBody.appendChild(row);
                    }
                }
            })
            .catch(error => console.error(error));
        function modifierEtatPermission(idPermission, newState) {
            fetch('../XmlOperations/modifier_permission.php?id=' + idPermission + '&state=' + newState)
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    location.reload();
                })
                .catch(error => console.error(error));
        }
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
