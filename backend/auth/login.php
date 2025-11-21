<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

$jsonServer = "http://jsonserver:3000/usuaris";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomUsuari = trim($_POST['nom_usuari']);
    $pass = trim($_POST['contrasenya']);

    $usuaris = json_get("$jsonServer?nom_usuari=$nomUsuari");

    if (count($usuaris) === 0) {
        die("L'usuari no existeix.");
    }

    $usuari = $usuaris[0];

    if (!password_verify($pass, $usuari['contrasenya'])) {
        die("Contrasenya incorrecta.");
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $usuari['id'];

    setcookie('user_id', $usuari['id'], time() + 3600, "/");

    echo "Sessió iniciada correctament.";
    echo "<br><a href='profile.php'>Vore perfil</a>";
    exit;
}
?>

<form method="post">
    <input type="text" name="nom_usuari" placeholder="Nom d'usuari" required>
    <input type="password" name="contrasenya" placeholder="Contrasenya" required>
    <button type="submit">Iniciar sessió</button>
</form>
