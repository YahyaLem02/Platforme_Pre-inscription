
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <a href="index.php">
                <img src="../assets/img/logoSchool.png" alt="Nom de votre entreprise">
            </a>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <?php
        if (!isset($_SESSION["connect"])) {?>
                <li><a class="nav-link scrollto" href="index.php" data-translate="menu.home"></a></li>
                <li class="dropdown">
                    <a href="#"><span data-translate="menu.our_programs"></span> <i
                            class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="http://www.ests.uca.ma/?page_id=61" data-translate="menu.mechatronics"></a></li>
                        <li><a href="http://www.ests.uca.ma/?page_id=63" data-translate="menu.systems_engineering"></a>
                        </li>
                        <li><a href="http://www.ests.uca.ma/?page_id=65"
                                data-translate="menu.accounting_management"></a></li>
                        <li><a href="http://www.ests.uca.ma/?page_id=67" data-translate="menu.metrology_quality"></a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="inscrire.php" data-translate="menu.register"></a></li>
                <li><a class="nav-link scrollto" href="connecter.php" data-translate="menu.login"></a></li>
                <li class="lang-selector">
                    <select id="languageSelector">
                        <option value="french" id="frenchButton" <?php if ($_SESSION['lang'] == 'french') {
                            echo 'selected="selected"';
                        } ?>>Français</option>
                        <option value="english" id="englishButton" <?php if ($_SESSION['lang'] == 'english') {
                            echo 'selected="selected"';
                        } ?>>English</option>
                        <option value="arabic" id="arabicButton" <?php if ($_SESSION['lang'] == 'arabic') {
                            echo 'selected="selected"';
                        } ?>>العربية</option>
                    </select>

                </li>
                <?php
                }
                ?>
                <?php if (isset($_SESSION["connect"]) && $_SESSION["connect"] == true) {?>
                <li><a href="../XmlOperations/DeconnexionAction.php">Déconnexion</a></li>
                <li class="lang-selector">
                    <select id="languageSelector">
                        <option value="french" id="frenchButton" <?php if ($_SESSION['lang'] == 'french') {
                            echo 'selected="selected"';
                        } ?>>Français</option>
                        <option value="english" id="englishButton" <?php if ($_SESSION['lang'] == 'english') {
                            echo 'selected="selected"';
                        } ?>>English</option>
                        <option value="arabic" id="arabicButton" <?php if ($_SESSION['lang'] == 'arabic') {
                            echo 'selected="selected"';
                        } ?>>العربية</option>
                    </select>

                </li>
                <?php
                }
                ?>
             
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <style>
            .lang-selector {
                margin-left: 10px;
            }

            #languageSelector {
                padding: 8px;
                border-radius: 4px;
                background-color: #eee;
                border: none;
                cursor: pointer;
            }
        </style>
    </div>
</header