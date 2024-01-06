<?php
session_start();

$_SESSION = array();

session_destroy();

header('Location: ../Welcome/connecter.php');
exit;
?>
