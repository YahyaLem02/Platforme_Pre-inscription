<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Destinataire de l'email
    $to = "lemkharbechy@gmail.com";

    // Construction du message
    $email_body = "Nom: $name\n" .
        "Email: $email\n" .
        "Sujet: $subject\n" .
        "Message:\n$message";

    // En-têtes de l'email
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email\n";

    // Configuration des paramètres SMTP
    ini_set("SMTP", "localhost"); // Adresse du serveur SMTP
    ini_set("smtp_port", "25");   // Port SMTP

    // Envoi de l'email
    if (mail($to, $subject, $email_body, $headers)) {
        header("Location: index.php");
    } else {
        echo "L'envoi de l'email a échoué. Veuillez vérifier la configuration SMTP.";
    }
}
?>
