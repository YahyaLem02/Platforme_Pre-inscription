<?php
include '../XmlOperations/Permissions.php';
?>
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
                <?php if (isset($_SESSION["connect"]) && $_SESSION["connect"] == true && isset($_SESSION["chefDep"]) && $_SESSION['chefDep'] == true) {?>
                <li><a class="nav-link scrollto" href="index.php" data-translate="menu.home"></a></li>
                <?php if($GestionActualites){?>
                <li><a href="MesActualites.php"data-translate="headerChef.Mes actualités"></a></li>
                <?php }?>
                <?php if($ConsulterCandidatures){?>
                <li><a href="ListeCandidat.php"data-translate="headerChef.Liste des candidat"></a></li>
                <?php }?>
                <li><a href="../XmlOperations/DeconnexionAction.php" data-translate="headerCandidat.Quitter"></a></li>
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
                <?php } ?>
                <?php if (isset($_SESSION["connect"]) && $_SESSION["connect"] == true && $_SESSION['candidat'] == true) {?>
                    <?php if(isset($_SESSION["AccesForm"]) && $_SESSION["AccesForm"] == false) { ?>
                <li><a class="nav-link scrollto" href="index.php" data-translate="menu.home"></a></li>
                <?php if($VoirActualites){?>
                <li><a href="actualite.php"data-translate="headerCandidat.Actualités"></a></li>
                <?php }?>
                <?php if($VoirInfosPersonnelles){?>
                <li class="dropdown">
                    <a href="#" data-translate="headerCandidat.Mes informations"</i>><span></span> <i
                            class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="personalInfos.php"
                                data-translate="headerCandidat.Les informations personnelles"></a></li>
                        <li><a href="diplomeInfos.php" data-translate="headerCandidat.Les informations diplômes"></a>
                        </li>
                        <li><a href="bacInfos.php" data-translate="headerCandidat.Les informations bac"></a></li>
                        <li><a href="ExperiencePro.php"
                                data-translate="headerCandidat.Les informations expériences professionnelles"></a></li>
                    </ul>
                </li>
                <?php }?>
                <?php if($VoirCandidatures){?>
                <li><a href="candidatureInfos.php" data-translate="headerCandidat.Mes candidatures"></a></li>
                <?php }?>
                <?php }?>
                <li><a href="../XmlOperations/DeconnexionAction.php" data-translate="headerCandidat.Quitter"></a></li>
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
                <?php } ?>
                <?php if (isset($_SESSION["connect"]) && $_SESSION["connect"] == true && isset($_SESSION["root"]) && $_SESSION['root'] == true) {?>
                <li><a class="nav-link scrollto" href="index.php" data-translate="menu.home"></a></li>
                <li><a class="nav-link scrollto" href="GestionPermissions.php">Gestion des permissions</a></li>
                <li><a class="nav-link scrollto" href="GestionUtilisateur.php">Gestion des utilisateurs</a></li>
                <li><a href="../XmlOperations/DeconnexionAction.php" data-translate="headerCandidat.Quitter"></a></li>
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
                    <?php } ?>
                    <?php if (isset($_SESSION["connect"]) && $_SESSION["connect"] == true && isset($_SESSION["agentScolarite"]) && $_SESSION['agentScolarite'] == true) {?>
                <li><a class="nav-link scrollto" href="index.php" data-translate="menu.home"></a></li>
                <li><a class="nav-link scrollto" href="ListeCandidats.php">Liste des candidats</a></li>
                <li><a href="../XmlOperations/DeconnexionAction.php" data-translate="headerCandidat.Quitter"></a></li>
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
                    <?php } ?>
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

            ul li a {
                text-decoration: none;
            }
        </style>
    </div>
</header
