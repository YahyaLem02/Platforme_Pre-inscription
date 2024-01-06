<?php
session_start();

if ($_GET['lang'] === 'english' || $_GET['lang'] === 'french' || $_GET['lang'] === 'arabic') {
    $_SESSION['lang'] = $_GET['lang'];

    $xml = simplexml_load_file('../xml/BaseXml.xml');
    foreach ($xml->Utilisateurs->Utilisateur as $utilisateur) {
        if (trim($utilisateur['CIN']) == trim($_SESSION['cin'])) {
            $utilisateur['Langue'] = $_GET['lang'];
        }
    }

    $xml->asXML('../xml/BaseXml.xml');
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
