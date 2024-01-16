<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'french'; // Langue par défaut
}

$xml = simplexml_load_file('../xml/BaseXml.xml');

if ($xml !== false) {
    foreach ($xml->Utilisateurs->Utilisateur as $utilisateur) {
        if ($utilisateur['CIN'] == $_SESSION['cin']) {
            $_SESSION['lang'] = (string) $utilisateur['Langue']; 
            break; 
        }
    }
}

if ($_SESSION['lang'] === 'english') {
    $lang_file = '../Translation/english.json';
} elseif ($_SESSION['lang'] === 'arabic') {
    $lang_file = '../Translation/arab.json';
} else {
    $lang_file = '../Translation/french.json';
}

$lang_content = file_get_contents($lang_file);
$lang = json_decode($lang_content, true);
