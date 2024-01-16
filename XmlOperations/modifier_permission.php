<?php
if (isset($_GET['id']) && isset($_GET['state'])) {
    $idPermission = $_GET['id'];
    $newState = $_GET['state'];

    $xml = new DOMDocument();
    $xml->load('../xml/BaseXml.xml');
    $xpath = new DOMXPath($xml);
    $permission = $xpath->query("//Permission[@IdPermission='$idPermission']")->item(0);

    if ($permission) {
        $permission->setAttribute('state', $newState);
        $xml->save('../xml/BaseXml.xml');
        $messageSuccess = 'Données modifiées avec succès.';
        header('Location: ../SuperAdmin/GestionPermissions.php?messageSuccess=' . urlencode($messageSuccess));
        exit();

    }
}



?>