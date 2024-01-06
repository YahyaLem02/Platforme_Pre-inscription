<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'french'; // Langue par défaut
}

// Charger le fichier XML
$xml = simplexml_load_file('../xml/BaseXml.xml');

if ($xml !== false) {
    foreach ($xml->Utilisateurs->Utilisateur as $utilisateur) {
        if ($utilisateur['CIN'] == $_SESSION['cin']) {
            $_SESSION['lang'] = (string) $utilisateur['Langue']; // Mettre à jour la langue depuis le fichier XML
            break; // Sortir de la boucle une fois la langue trouvée
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
