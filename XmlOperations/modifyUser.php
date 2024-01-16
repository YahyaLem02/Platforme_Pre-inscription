<?php
$xmlPath = '../xml/BaseXml.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cinUtilisateurAModifier = $_POST['cinUtilisateurAModifier'];
    $nomComplet = $_POST['nomComplet'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $profil = $_POST['profil'];
    $departement = isset($_POST['departement']) ? $_POST['departement'] : '';

    $xml = simplexml_load_file($xmlPath);
    $utilisateur = $xml->xpath("//Utilisateur[@CIN='$cinUtilisateurAModifier']");

    if ($utilisateur) {
        $utilisateur[0]->nomComplet = $nomComplet;
        $utilisateur[0]->login = $login;
        $utilisateur[0]->password = $password;
        $utilisateur[0]['role'] = $profil;

        if ($profil === 'rol2' && !empty($departement)) {
            $utilisateur[0]['Dep'] = $departement;
        } elseif (isset($utilisateur[0]['Dep'])) {
            unset($utilisateur[0]['Dep']);
        }

        $xml->asXML($xmlPath);
        $messageSuccess = "Données modifiées avec succès.";
        header('Location: ../SuperAdmin/GestionUtilisateur?messageSuccess=' . urlencode($messageSuccess));
        exit();
  }}