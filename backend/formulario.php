<?php
// Inicializamos variables para mensajes
$success = "";
$error = "";

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger y limpiar datos
    $nombre = strip_tags(trim($_POST["nombre"]));
    $apellidos = strip_tags(trim($_POST["apellidos"]));
    $edad = filter_var(trim($_POST["edad"]), FILTER_VALIDATE_INT);
    $telefono = strip_tags(trim($_POST["telefono"]));
    $localidad = strip_tags(trim($_POST["localidad"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $contrasena = trim($_POST["contrasena"]);

    // Validación básica
    if (empty($nombre) || empty($apellidos) || empty($edad) || empty($telefono) ||
        empty($localidad) || empty($email) || empty($contrasena)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } elseif ($edad < 1 || $edad > 120) {
        $error = "Edad no válida.";
    } elseif (!preg_match("/^[0-9]{9}$/", $telefono)) {
        $error = "Teléfono no válido (debe tener 9 dígitos).";
    } elseif (strlen($contrasena) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Destinatario
        $to = "tucorreo@dominio.com";  // Cambia por tu correo real
        $subject = "Nuevo mensaje de contacto de $nombre $apellidos";

        // Contenido del correo
        $email_content = "Nombre: $nombre\n";
        $email_content .= "Apellidos: $apellidos\n";
        $email_content .= "Edad: $edad\n";
        $email_content .= "Teléfono: $telefono\n";
        $email_content .= "Localidad: $localidad\n"; 
        $email_content .= "Correo: $email\n\n";
        $email_content .= "Contraseña: $contrasena\n";

        // Encabezados
        $headers = "From: $nombre <$email>";

        // Enviar correo
        if (mail($to, $subject, $email_content, $headers)) {
            $success = "Mensaje enviado correctamente!";
        } else {
            $error = "Ha ocurrido un error enviando el mensaje.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
</head>
<body>
    <h1>Formulario de Contacto</h1>

    <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="1" max="120" required>
        <br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" pattern="[0-9]{9}" required>
        <br><br>

        <label for="localidad">Localidad:</label>
        <input type="text" id="localidad" name="localidad" required>
        <br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required minlength="6">
        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
