<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomUsuari = trim($_POST['nom_usuari']);
    $email     = trim($_POST['email']);
    $contrasenya = $_POST['contrasenya'];

    if (!$nomUsuari || !$email || !$contrasenya) {
        $error = "Todos los campos son obligatorios";
    } else {
        $usuarios = json_get("usuaris?nom_usuari=" . urlencode($nomUsuari));
        if (!empty($usuarios)) {
            $error = "El usuario ya existe";
        } else {
            $data = [
                "nom_usuari"   => $nomUsuari,
                "contrasenya"  => password_hash($contrasenya, PASSWORD_DEFAULT),
                "email"        => $email,
                "nom"          => $_POST['nom'] ?? '',
                "cognoms"      => $_POST['cognoms'] ?? '',
                "data_registre"=> date('c')
            ];
            $nuevo = json_post("usuaris", $data);
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registro</title></head>
<body>
<h1>Registro de usuario</h1>
<?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    <label>Usuario: <input type="text" name="nom_usuari" required></label><br><br>
    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Contraseña: <input type="password" name="contrasenya" required></label><br><br>
    <label>Nombre: <input type="text" name="nom"></label><br><br>
    <label>Apellidos: <input type="text" name="cognoms"></label><br><br>
    <button type="submit">Registrar</button>
</form>
<p><a href="login.php">Ya tengo cuenta</a></p>
</body>
</html>
