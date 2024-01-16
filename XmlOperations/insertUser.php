<?php
$xmlPath = '../xml/BaseXml.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomComplet = $_POST['nomComplet'];
    $CIN = $_POST['CIN'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $profil = $_POST['profil'];
    $departement = isset($_POST['departement']) ? $_POST['departement'] : '';
    $xml = simplexml_load_file($xmlPath);
    $utilisateurs = $xml->xpath("//Utilisateurs");
    if (count($utilisateurs) > 0) {
        $utilisateur = $utilisateurs[0]->addChild('Utilisateur');
        $utilisateur->addChild('nomComplet', $nomComplet);
        $utilisateur->addChild('login', $login);
        $utilisateur->addChild('password', $password);
        $utilisateur->addAttribute('CIN', $CIN);
        $utilisateur->addAttribute('role', $profil);
        if ($profil === 'rol2' && !empty($departement)) {
            $utilisateur->addAttribute('Dep', $departement);
        }
        $xml->asXML($xmlPath);
        $messageSuccess = "Données insérées avec succès.";
        header('Location: ../SuperAdmin/GestionUtilisateur?messageSuccess=' . urlencode($messageSuccess));
        exit();
    } else {
        echo "Erreur : Élément parent 'Utilisateurs' non trouvé dans le fichier XML.";
    }
}
?>
