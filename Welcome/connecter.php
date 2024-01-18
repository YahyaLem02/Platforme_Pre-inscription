<?php
include '../Translation/headerTranslation.php';
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
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/sweetalert/dist/sweetalert.css">

</head>

<body id="bodyInscrrire">
    <?php include '../Layouts/header.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h2 class="text-center" data-translate="form.title-conncet"></h2>
                    <div class="card-body py-md-4">

                        <div class="card-body py-md-4">
                            <form method="post" action="../XmlOperations/VerifierConnexion.php">
                                <div class="form-group">
                                    <label for="email" data-translate="form.emailLabel">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Example@gmail.com" data-translate="form.email">
                                </div>
                                <div class="form-group">
                                    <label for="password" data-translate="form.passwordLabel">Mot de passe</label>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="***************" name="password" data-translate="form.password">
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <a href="inscrire.php" data-translate="form.link">Je n'ai pas un compte</a>
                                    <button id="registerBtn" class="btn btn-primary " type="submit"
                                        data-translate="form.login">Se connecter</button>
                                </div>
                            </form>
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
            echo "<script src='../node_modules/sweetalert/dist/sweetalert.min.js'></script>";
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
        <script src="../Translation/language.js"></script>
        <script src="../assets/js/inscrire.js"></script>

</body>

</html>
