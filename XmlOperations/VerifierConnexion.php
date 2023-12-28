<?php
$xmlFile = "../xml/BaseXml.xml";

$email = $_POST['email'];
$password = $_POST['password'];

$xml = simplexml_load_file($xmlFile);

$matchingCompte = $xml->xpath("//Utilisateur[login = '{$email}' and password = '{$password}']");

if ($matchingCompte) {
    header('Location: ../Succes.html');
    exit;
} else {
    $ErrorMessage = urlencode("Le login neexiste pas. Veuillez vérifier vos informations.");
    header('Location: ../connecter.php?messageError=' . $ErrorMessage);
    exit;
}
?>
