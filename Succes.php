<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Noud tn3ass

    <?php
session_start(); // Démarrage de la session

// Vérifie si $_SESSION["name"] est défini et affiche le nom s'il existe
if (isset($_SESSION["name"])) {
    echo "Bonjour, ".$_SESSION["name"]."!";
} else {
    echo "Session non trouvée"; // Gestion des cas où la session n'est pas définie
}
?>



    <a href="XmlOperations/DeconnexionAction.php">Déconnexion</a>

</body>
</html>