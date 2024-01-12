<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idActualite'])) {
    $actualiteIdToDelete = $_GET['idActualite'];
    $xml = new DOMDocument;
    $xml->load('../Xml/BaseXml.xml');
    $xpath = new DOMXPath($xml);
    $actualiteNode = $xpath->query("//Actualite[@idActualite='{$actualiteIdToDelete}']")->item(0);

    if ($actualiteNode) {
        $actualiteNode->parentNode->removeChild($actualiteNode);
        $xml->save('../Xml/BaseXml.xml');
        $messageSuccess = 'Les données supprimée avec succès.';
        header('Location: ../ChefDepartement/MesActualites.php?messageSuccess=' . urlencode($messageSuccess));
    } else {
        $messageSuccess = 'Actualite not found';
        header('Location: ../ChefDepartement/MesActualites.php?messageSuccess=' . urlencode($messageSuccess));
    }
} else {
    $messageSuccess = 'Invalid request';
    header('Location: ../ChefDepartement/MesActualites.php?messageSuccess=' . urlencode($messageSuccess));
}
?>
