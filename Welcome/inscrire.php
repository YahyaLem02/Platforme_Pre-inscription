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

</head>

<body id="bodyInscrrire">
    <?php
    include '../Layouts/header.php';
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card" id="form">
                    <!-- Ajoutez data-translate aux éléments nécessitant une traduction -->
                    <h2 class="text-center" data-translate="form.title">Créer votre compte</h2>                    <div class="card-body py-md-4">
                        <form method="post" action="../XmlOperations/InscrireAction.php">
                            <div class="form-group">
                                <label for="Nom et prenom" data-translate="form.name"></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ex:Ali alami">
                            </div>
                            <div class="form-group">
                                <label for="" data-translate="form.cin"></label>
                                <input type="text" class="form-control" id="cin" name="cin"
                                    placeholder="Ex: MD23328" data-translate="form.cin">
                            </div>
                            <div class="form-group" >
                                <label for="" data-translate="form.email"></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Ex: example@gmail.com" data-translate="form.email">
                            </div>
                            <div class="form-group">
                                <label for="" data-translate="form.password"></label>
                                <input type="password" class="form-control" id="password" placeholder="***********"
                                    >
                            </div>
                            <div class="form-group">
                                <label for=""  data-translate="form.confirm_password"></label>
                                <input type="password" class="form-control" id="confirm-password"
                                    placeholder="*******************" name="password"
                                   >
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <a href="connecter.php" data-translate="form.link">J'ai déjà un compte</a>
                                <button id="registerBtn" class="btn btn-primary disabled" type="submit"
                                    data-translate="form.register">S'inscrire</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn.disabled {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
    <?php
    
    if (isset($_GET['messageError'])) {
        $messageError = urldecode($_GET['messageError']);
        echo "<script src='../node_modules/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                swal('Erreur', '$messageError', 'error');
                            });
                          </script>";
    } ?>

    <?php
    include '../Layouts/footer.html';
    ?>
    <script src="../assets/js/inscrire.js"></script>
    <script>
        const passwordInput = document.getElementById("password");
        const confirmInput = document.getElementById("confirm-password");
        const registerButton = document.getElementById("registerBtn");

        passwordInput.addEventListener("input", validatePassword);
        confirmInput.addEventListener("input", validatePassword);

        function validatePassword() {
            const passwordValue = passwordInput.value;
            const confirmValue = confirmInput.value;

            if (passwordValue.length >= 8 && passwordValue === confirmValue && passwordValue !== '' && confirmValue !==
                '') {
                passwordInput.style.borderColor = "green";
                confirmInput.style.borderColor = "green";
                registerButton.classList.remove("disabled");
            } else {
                passwordInput.style.borderColor = "red";
                confirmInput.style.borderColor = "red";
                registerButton.classList.add("disabled");
            }
        }
    </script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/language.js"></script>


</body>

</html>
