<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'french'; // Langue par défaut
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
?>
