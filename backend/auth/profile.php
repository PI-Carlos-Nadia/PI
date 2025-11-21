<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

$jsonServer = "http://jsonserver:3005/usuaris";

if (!isset($_SESSION['user_id'])) {
    die("Has d'iniciar sessió. <a href='login.php'>Login</a>");
}

$id = intval($_SESSION['user_id']);
$usuari = json_get("$jsonServer/$id");

echo "<h2>Perfil de {$usuari['nom_usuari']}</h2>";
echo "Email: {$usuari['email']} <br>";
echo "Nom: {$usuari['nom']} <br>";
echo "Cognoms: {$usuari['cognoms']} <br>";

echo "<br><a href='logout.php'>Tancar sessió</a>";
