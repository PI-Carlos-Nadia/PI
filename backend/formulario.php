<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger y limpiar datos
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validación básica
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Hi ha hagut un error amb el formulari. Torna-ho a intentar.";
        exit;
    }

    // Destinatario
    $to = "tuemail@domini.com";  // Cambia por tu correo
    $subject = "Nou missatge de $name";

    // Contenido del correo
    $email_content = "Nom: $name\n";
    $email_content .= "Correu electrònic: $email\n\n";
    $email_content .= "Missatge:\n$message\n";

    // Encabezados
    $headers = "From: $name <$email>";

    // Enviar correo
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Missatge enviat correctament!";
    } else {
        echo "Hi ha hagut un error enviant el missatge.";
    }

} else {
    echo "Accés no permès.";
}
?>
