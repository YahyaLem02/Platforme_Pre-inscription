<?php
$xmlFile = "../xml/BaseXml.xml";

$name = $_POST['name'];
$cin = $_POST['cin'];
$email = $_POST['email'];
$password = $_POST['password'];

$xml = simplexml_load_file($xmlFile);

$emailExists = false;
foreach ($xml->xpath('//Utilisateur/login') as $existingEmail) {
    if ((string)$existingEmail === $email) {
        $emailExists = true;
        break;
    }
}

$cinExists = false;
foreach ($xml->xpath('//Utilisateur') as $existingCompte) {
    if ($existingCompte['CIN'] == $cin) {
        $cinExists = true;
        break;
    }
}


if ($emailExists || $cinExists) {
    $messageError = "Email ou le numéro CIN existe déjà.";
    header('Location: ../inscrire.php?messageError=' . urlencode($messageError));
    exit;
} else {
    $comptes = $xml->xpath('//Utilisateurs');
    if (!empty($comptes)) {
        $newCompte = $comptes[0]->addChild('Utilisateur');
        $newCompte->addAttribute('CIN', $cin);
        $newCompte->addAttribute('Langue', 'french');
        $newCompte->addAttribute('role','rol1');
        $newCompte->addChild('nomComplet', $name);
        $newCompte->addChild('login', $email);
        $newCompte->addChild('password', $password);
        $xml->asXML($xmlFile);
        $messageSuccess = "Données insérées avec succès.";
        header('Location: ../Welcome/connecter.php?messageSuccess=' . urlencode($messageSuccess));
        exit;
    }
}
?>
