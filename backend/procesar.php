<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $ciclo = trim($_POST['ciclo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $consent = isset($_POST['consent']) ? '1' : '';

    $errores = [];

    if (empty($nombre)) $errores[] = "Introduce un nombre.";
    if (empty($correo)) $errores[] = "Introduce un correo electrónico.";
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido.";
    if (empty($ciclo)) $errores[] = "Selecciona un ciclo formativo.";
    if (empty($telefono)) $errores[] = "Introduce un teléfono.";
    if (empty($consent)) $errores[] = "Debes consentir el tratamiento de datos.";

    if (!empty($errores)) {
        $_SESSION['datos'] = [
            'nombre' => $nombre,
            'correo' => $correo,
            'ciclo' => $ciclo,
            'telefono' => $telefono,
            'consent' => $consent
        ];
        $_SESSION['errores'] = $errores;

        header("Location: formulario.php");
        exit;
   } else {

    require_once __DIR__ . '/includes/json_connect.php';
    $jsonServer = "http://jsonserver:3005/usuaris";

    // Crear usuario a partir de formulario
    $nouUsuari = [
        "nom_usuari" => explode('@', $correo)[0],  // nombre antes del @ como usuario
        "contrasenya" => password_hash("1234", PASSWORD_DEFAULT), // contraseña fija o genera otra
        "email" => $correo,
        "nom" => $nombre,
        "cognoms" => "",
        "data_registre" => date('c')
    ];

    // Guardar en JSON (igual que Register)
    $resultat = json_post($jsonServer, $nouUsuari);

    unset($_SESSION['datos']);

    echo "<h2>El registro se ha realizado con éxito</h2>";
    

    if ($resultat) {
        echo "<p>Usuario creado correctamente en JSON.</p>";
    } else {
        echo "<p>Error al crear el usuario en JSON.</p>";
    }

    echo '<a href="formulario.php">Volver al formulario</a>';
}
}
