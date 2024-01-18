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
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <?php
    include '../Layouts/header.php';
    ?>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="d-flex">
                <a href="inscrire.php" class="btn-get-started scrollto"
                    data-translate="hero_section.preinscription_button"></a>
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Featured Services Section ======= -->
        <section id="filiere" class="featured-services">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <?php
                    $xml = new DOMDocument();
                    $xml->load('../xml/baseXml.xml');
                    $xpath = new DOMXPath($xml);
                    $query = '';
                    if ($_SESSION['lang'] === 'english') {
                        $query = '/root/FiliereSouhaites/FiliereSouhaite[@lang="english"]';
                    } elseif ($_SESSION['lang'] === 'french') {
                        $query = '/root/FiliereSouhaites/FiliereSouhaite[@lang="french"]';
                    } elseif ($_SESSION['lang'] === 'arabic') {
                        $query = '/root/FiliereSouhaites/FiliereSouhaite[@lang="arabic"]';
                    }
                    $result = $xpath->query($query);
                    if ($result->length > 0) {
                        $delay = 100;
                        foreach ($result as $filiere) {
                            $intitule = $filiere->getElementsByTagName('intituleFiliere')->item(0)->nodeValue;
                            $description = $filiere->getElementsByTagName('DescriptionFiliere')->item(0)->nodeValue;
                            $iconClass = '';
                    
                            switch ($_SESSION['lang']) {
                                case 'english':
                                    switch ($intitule) {
                                        case 'MECHATRONICS':
                                            $iconClass = 'bi bi-gear';
                                            break;
                                        case 'INFORMATION SYSTEMS AND NETWORKS ENGINEERING':
                                            $iconClass = 'bi bi-laptop';
                                            break;
                                        case 'ACCOUNTING AND FINANCIAL MANAGEMENT':
                                            $iconClass = 'bi bi-wallet2';
                                            break;
                                        case 'METROLOGY, QUALITY, SAFETY, AND ENVIRONMENT':
                                            $iconClass = 'bi bi-eye';
                                            break;
                                        default:
                                            $iconClass = 'bi bi-file-earmark-text';
                                            break;
                                    }
                                    break;
                                case 'french':
                                    switch ($intitule) {
                                        case 'MÉCATRONIQUE':
                                            $iconClass = 'bi bi-gear';
                                            break;
                                        case 'INGÉNIERIE DES SYSTÈMES D\'INFORMATION ET RÉSEAUX':
                                            $iconClass = 'bi bi-laptop';
                                            break;
                                        case 'GESTION COMPTABLE ET FINANCIÈRE':
                                            $iconClass = 'bi bi-wallet2';
                                            break;
                                        case 'MÉTROLOGIE, QUALITÉ, SÉCURITÉ ET ENVIRONNEMENT':
                                            $iconClass = 'bi bi-eye';
                                            break;
                                        default:
                                            $iconClass = 'bi bi-file-earmark-text';
                                            break;
                                    }
                                    break;
                                case 'arabic':
                                    switch ($intitule) {
                                        case 'الميكاترونيات':
                                            $iconClass = 'bi bi-gear';
                                            break;
                                        case 'هندسة أنظمة المعلومات والشبكات':
                                            $iconClass = 'bi bi-laptop';
                                            break;
                                        case 'إدارة المحاسبة والمالية':
                                            $iconClass = 'bi bi-wallet2';
                                            break;
                                        case 'القياس والجودة والسلامة والبيئة':
                                            $iconClass = 'bi bi-eye';
                                            break;
                                        default:
                                            $iconClass = 'bi bi-file-earmark-text';
                                            break;
                                    }
                                    break;
                                default:
                                    $iconClass = 'bi bi-file-earmark-text';
                                    break;
                            }
                    
                            echo '<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">';
                            echo '<div class="icon-box" data-aos="fade-up" data-aos-delay="' . $delay . '">';
                            echo '<div class="icon"><i class="' . $iconClass . '"></i></div>';
                            echo '<h4 class="title"><a href="#">' . $intitule . '</a></h4>';
                            echo '<p class="description">' . $description . '</p>';
                            echo '</div></div>';
                            $delay += 100;
                        }
                    } else {
                        echo 'Aucune filière trouvée.';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- ======= Counts Section ======= -->
     
        <!-- End Counts Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2 data-translate="contact.title"></h2>
                    <h3 data-translate="contact.subtitle"><span></span></h3>
                    <p data-translate="contact.content"></p>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3 data-translate="contact.address.label"></h3>
                            <p data-translate="contact.address.value"></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3 data-translate="contact.email.label"></h3>
                            <p data-translate="contact.email.value"></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3 data-translate="contact.phone.label"></h3>
                            <p data-translate="contact.phone.value"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6">
                    <iframe class="mb-4 mb-lg-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3372.150481872137!2d-9.218748884861483!3d32.30781068111619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdac20c13554a6a3%3A0xe0bcd1e33a700800!2sEcole+Sup%C3%A9rieure+de+T%C3%A9chnologie!5e0!3m2!1sfr!2sma!4v1560955562472!5m2!1sfr!2sma"
                        frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>
                <div class="col-lg-6">
                    <form action="./contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col form-group">
                                <label for="name" data-translate="contact.placeholders.name"></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    data-translate="contact.placeholders.name" required>
                            </div>
                            <div class="col form-group">
                                <label for="email" data-translate="contact.placeholders.email"></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    data-translate="contact.placeholders.email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" data-translate="contact.placeholders.subject"></label>
                            <input type="text" class="form-control" name="subject" id="subject"
                                data-translate="contact.placeholders.subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message" data-translate="contact.placeholders.message"></label>
                            <textarea class="form-control" name="message" rows="5" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading" data-translate="contact.placeholders.loading"></div>
                            <div class="error-message" data-translate="contact.placeholders.error_message"></div>
                            <div class="sent-message" data-translate="contact.placeholders.sent_message"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" data-translate="contact.placeholders.send_button"></button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h3 data-translate="footer.contact.title"></h3>
                        <p data-translate="footer.contact.address"></p>
                        <p>
                            <strong data-translate="footer.contact.phone.title"></strong>
                            <span data-translate="footer.contact.phone"></span><br>
                            <strong data-translate="footer.contact.email.title"></strong>
                            <span data-translate="footer.contact.email"></span>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4 data-translate="footer.useful_links.title"></h4>
                        <ul>
                            <li><a href="#" data-translate="footer.useful_links.links.0.text"></a></li>
                            <li><a href="#" data-translate="footer.useful_links.links.1.text"></a></li>
                            <li><a href="#" data-translate="footer.useful_links.links.2.text"></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-info">
                        <h3 data-translate="footer.stay_connected.title"></h3>
                        <p data-translate="footer.stay_connected.description"></p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-2">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="credits text-center" data-translate="footer.credits.text"></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Ajouter ce bouton où vous souhaitez changer de langue -->
    <!-- End Footer -->
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script>
        const lang = <?php echo json_encode($lang); ?>;
    </script>
    <script src="../Translation/language.js"></script>
    <script src="../Translation/rtl.js"></script>





</body>

</html>
