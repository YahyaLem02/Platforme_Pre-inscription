<?php
session_start();

$xmlFile = '../xml/BaseXml.xml';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $xml = simplexml_load_file($xmlFile);

    // Utilisation de htmlspecialchars pour éviter les attaques XSS
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $_SESSION['candidat'] = false;
    $_SESSION['chefDep'] = false;
    $_SESSION['root'] = false;
    $_SESSION['agentScolarite'] = false;
    $_SESSION['AccesForm'] = false;

    $matchingCompte = $xml->xpath("//Utilisateur[login = '{$email}' and password = '{$password}']");

    if ($matchingCompte) {
        $firstMatch = $matchingCompte[0];
        $nomComplet = (string) $firstMatch->nomComplet;
        $cinUtilisateur = (string) $firstMatch['CIN'];
        $role = (string) $firstMatch['role'];
        $_SESSION['name'] = $nomComplet;
        $_SESSION['cin'] = $cinUtilisateur;
        $_SESSION['connect'] = true;

        if ($role == 'rol1') {
            $candidatAssocie = $xml->xpath("//candidat[@Utilisateur = '{$cinUtilisateur}']");
            $_SESSION['candidat'] = true;
            if (!$candidatAssocie) {
                $_SESSION['AccesForm'] = true;
                header('Location: ../Candidature/form.php');
                exit();
            } else {
                header('Location: ../Candidature/');
                exit();
            }
        } elseif ($role == 'rol2') {
            $_SESSION['chefDep'] = true;
            $Departement = (string) $firstMatch['Dep'];
            $Filiere = (string) $xml->xpath("//Departement[@sigle='" . $Departement . "']/@Filiere")[0];
            $_SESSION['idFiliere'] = $Filiere;
            $NomDep = (string) $xml->xpath("//Departement[@sigle='" . $Departement . "']/Nom")[0];
            $_SESSION['NomDep'] = $NomDep;
            $NomFiliere = (string) $xml->xpath("//FiliereSouhaite[@idFiliere='" . $Filiere . "']/intituleFiliere")[0];
            $_SESSION['NomFiliere'] = $NomFiliere;
            header('Location: ../ChefDepartement/index.php');

        } elseif ($role == 'rol3') {
            $_SESSION['root'] = true;
            header('Location: ../SuperAdmin/index.php');
        }
        elseif ($role == 'rol4') {
            $_SESSION['agentScolarite'] = true;
            header('Location: ../agentScolarite/index.php');
        }
    } else {
        $ErrorMessage = urlencode('Le login n existe pas. Veuillez vérifier vos informations.');
        header('Location: ../Welcome/connecter.php?messageError=' . $ErrorMessage);
        exit();
    }
}
?>
