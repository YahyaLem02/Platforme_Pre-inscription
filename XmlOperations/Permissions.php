<?php
$xmlFile = '../xml/BaseXml.xml';
$xml = new DOMDocument();
$xml->load($xmlFile);
$xpath = new DOMXPath($xml);
$permissions = $xpath->query('//Permission');

foreach ($permissions as $permission) {
    $state = $permission->getAttribute('state');
    $text = $xpath->evaluate('string(for)', $permission);
    if ($text === 'Voir actualités') {
        $VoirActualites = $state;
    } elseif ($text === 'Voir les informations personnelles') {
        $VoirInfosPersonnelles = $state;
    } elseif ($text === 'Modifier les informations personnelles') {
        $ModifierInfosPersonnelles = $state;
    } elseif ($text === 'Voir candidatures') {
        $VoirCandidatures = $state;
    } elseif ($text === 'Modifier candidature') {
        $ModifierCandidature = $state;
    } elseif ($text === 'Ajouter candidature') {
        $AjouterCandidature = $state;
    } elseif ($text === 'Supprimer candidature') {
        $SupprimerCandidature = $state;
    } elseif ($text === 'Consulter candidatures') {
        $ConsulterCandidatures = $state;
    } elseif ($text === 'Gestion actualités') {
        $GestionActualites = $state;
    } elseif ($text === 'Ajouter actualité') {
        $AjouterActualite = $state;
    } elseif ($text === 'Supprimer actualité') {
        $SupprimerActualite = $state;
    } elseif ($text === 'Modifier actualité') {
        $ModifierActualite = $state;
    }
}

//Les sessions 
if (isset($_SESSION['candidat'])) {
    $isCandidat = $_SESSION['candidat'];
}
if (isset($_SESSION['agentScolarite'])) {
    $isAgentScolarite = $_SESSION['agentScolarite'];
}
if (isset($_SESSION['root'])) {
    $isRoot = $_SESSION['root'];
}
if (isset($_SESSION['chefDep'])) {
    $isChefDep = $_SESSION['chefDep'];
}



if (!function_exists('redirectIfNotAuthorized')) {
    function redirectIfNotAuthorized($permission){
        if(!$permission) {
            header("Location: pageNonTrouve.php");
            exit(); 
        }
    }
}

if (!function_exists('canAccessPage')) {
    function canAccessPage($session){
        if(!$session) {
            header("Location: pageNonTrouve.php");
            exit(); 
        }
    }
}
?>