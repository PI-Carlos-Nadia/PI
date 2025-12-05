<?php
session_start();
require_once __DIR__ . '/../includes/json_connect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$jsonServer = "http://jsonserver:3005/usuaris";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomUsuari = trim($_POST['nom_usuari']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['contrasenya']);
    $nom = trim($_POST['nom']);
    $cognoms = trim($_POST['cognoms']);

    if (!$nomUsuari || !$email || !$pass) {
        die("Tots els camps són obligatoris.");
    }

    $existeix = json_get("$jsonServer?nom_usuari=$nomUsuari");
    if (count($existeix) > 0) {
        die("Aquest nom d'usuari ja existeix.");
    }

    $nouUsuari = [
        "nom_usuari" => $nomUsuari,
        "contrasenya" => password_hash($pass, PASSWORD_DEFAULT),
        "email" => $email,
        "nom" => $nom,
        "cognoms" => $cognoms,
        "data_registre" => date('c')
    ];

    $resultat = json_post($jsonServer, $nouUsuari);

    if ($resultat) {
        echo "Usuari registrat correctament";
        echo "<br><a href='login.php'>Iniciar sessió</a>";
    } else {
        echo "Error al registrar usuari.";
    }

    exit;
}
?>

<form method="post">
    <input type="text" name="nom_usuari" placeholder="Nom d'usuari" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="contrasenya" placeholder="Contrasenya" required>
    <input type="text" name="nom" placeholder="Nom">
    <input type="text" name="cognoms" placeholder="Cognoms">
    <button type="submit">Registrar-se</button>
</form>
