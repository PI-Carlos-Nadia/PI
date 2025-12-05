<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit;
}
$userId = $_SESSION['user_id'] ?? $_COOKIE['user_id'];
$usuario = json_get("usuaris/" . intval($userId));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = [
        "nom"     => $_POST['nom'] ?? $usuario['nom'],
        "cognoms" => $_POST['cognoms'] ?? $usuario['cognoms'],
        "email"   => $_POST['email'] ?? $usuario['email']
    ];
    $usuario = json_patch("usuaris/" . intval($userId), $update);
    $mensaje = "Perfil actualizado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Perfil</title></head>
<body>
<h1>Perfil de <?php echo htmlspecialchars($usuario['nom_usuari']); ?></h1>
<?php if (!empty($mensaje)) echo "<p style='color:green'>$mensaje</p>"; ?>
<form method="post">
    <label>Nombre: <input type="text" name="nom" value="<?php echo htmlspecialchars($usuario['nom']); ?>"></label><br><br>
    <label>Apellidos: <input type="text" name="cognoms" value="<?php echo htmlspecialchars($usuario['cognoms']); ?>"></label><br><br>
    <label>Email: <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>"></label><br><br>
    <button type="submit">Actualizar</button>
</form>
<p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
