<?php
$xmlPath = '../xml/BaseXml.xml';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cinToDelete'])) {
    $cinToDelete = $_GET['cinToDelete'];
    $xml = simplexml_load_file($xmlPath);

    $userToDelete = $xml->xpath("//Utilisateur[@CIN='$cinToDelete']");

    if (!empty($userToDelete)) {
        $actualitesToDelete = $xml->xpath("//Actualite[@idChef='$cinToDelete']");

        if (!empty($actualitesToDelete)) {
            foreach ($actualitesToDelete as $actualite) {
                $dom = dom_import_simplexml($actualite);
                $dom->parentNode->removeChild($dom);
            }
        }

        $domUser = dom_import_simplexml($userToDelete[0]);
        $domUser->parentNode->removeChild($domUser);

        $xml->asXML($xmlPath);

        $messageSuccess = "Utilisateur a été supprimé avec succès.";
        header('Location: ../SuperAdmin/GestionUtilisateur?messageSuccess=' . urlencode($messageSuccess));
        exit();
    } else {
        $messageError = "Utilisateur non trouvé.";
        header('Location: ../SuperAdmin/GestionUtilisateur?messageError=' . urlencode($messageError));
        exit();
    }
}
?>
