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
    $_SESSION['connect'] = false;
    $_SESSION['candidat'] = false;
    $_SESSION['AccesForm'] = false;

    $matchingCompte = $xml->xpath("//Utilisateur[login = '{$email}' and password = '{$password}']");

    if ($matchingCompte) {
        $firstMatch = $matchingCompte[0];
        $nomComplet = (string) $firstMatch->nomComplet;
        $cinUtilisateur = (string) $firstMatch['CIN'];

        $candidatAssocie = $xml->xpath("//candidat[@Utilisateur = '{$cinUtilisateur}']");
        $_SESSION['name'] = $nomComplet;
        $_SESSION['cin'] = $cinUtilisateur;
        $_SESSION['connect'] = true;
        $_SESSION['candidat'] = true;

        if (!$candidatAssocie) {
            $_SESSION['AccesForm'] = true;
            header('Location: ../Candidature/form.php');
            exit();
        } else {
            header('Location: ../Candidature/personalInfos.php');
            exit();
        }
    } else {
        $ErrorMessage = urlencode("Le login n'existe pas. Veuillez vérifier vos informations.");
        header('Location: ../connecter.php?messageError=' . $ErrorMessage);
        exit();
    }
} else {
    // Les paramètres email ou password ne sont pas définis dans $_POST
    // Peut-être afficher un message d'erreur ou rediriger vers une page d'erreur appropriée
    // Par exemple :
    // header('Location: ../error.php');
    // exit;
}
?>
