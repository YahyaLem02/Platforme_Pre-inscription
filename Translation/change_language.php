<?php
session_start();

if ($_GET['lang'] === 'english' || $_GET['lang'] === 'french'|| $_GET['lang'] === 'arabic') {
    $_SESSION['lang'] = $_GET['lang'];
}

// Redirection vers la page précédente
header("Location: " . $_SERVER['HTTP_REFERER']);
?>