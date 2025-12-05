<?php
// http://localhost:8080/auth/login.php

session_start();
require_once __DIR__ . '/../includes/json_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomUsuari   = trim($_POST['nom_usuari']);
    $contrasenya = $_POST['contrasenya'];

    $usuarios = json_get("usuaris?nom_usuari=" . urlencode($nomUsuari));
    if (!empty($usuarios) && password_verify($contrasenya, $usuarios[0]['contrasenya'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $usuarios[0]['id'];
        setcookie('user_id', $usuarios[0]['id'], time()+3600, "/");
        header("Location: profile.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h1>Iniciar sesión</h1>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    <label>Usuario: <input type="text" name="nom_usuari" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasenya" required></label><br><br>
    <button type="submit">Entrar</button>
</form>
<p><a href="register.php">¿No tienes cuenta? Regístrate</a></p>
</body>
</html>
