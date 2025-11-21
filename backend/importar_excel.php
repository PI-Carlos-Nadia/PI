<?php
require __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// 📁 Carpetas absolutas (dentro del contenedor PHP)
$uploadDir = '/var/www/uploads/';
$dataDir   = '/var/www/data/';
$jsonFile  = $dataDir . 'datos.json';

// 🧱 Asegura que existen
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
if (!is_dir($dataDir)) mkdir($dataDir, 0777, true);

// 🧾 Comprobar fitxer pujat
if (!isset($_FILES['excel'])) {
    die("No s'ha rebut cap fitxer.");
}

$file = $_FILES['excel'];
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

if (!in_array($ext, ['xls', 'xlsx', 'csv'])) {
    die("Format no vàlid. Només .xls, .xlsx o .csv");
}

// 📦 Guardar fitxer
$newName = 'productes_' . time() . '.' . $ext;
$path = $uploadDir . $newName;

if (!move_uploaded_file($file['tmp_name'], $path)) {
    die("Error en pujar el fitxer.");
}

// 📘 Llegir Excel
$spreadsheet = IOFactory::load($path);
$sheet = $spreadsheet->getActiveSheet();
$rows = $sheet->toArray(null, true, true, true);

// 🧠 Processar dades
$productes = [];
$id = 1;

foreach ($rows as $index => $row) {
    if ($index == 1) continue; // omet encapçalament

    $sku = trim($row['A']);
    $nom = trim($row['B']);
    $descripcio = trim($row['C']);
    $img = trim($row['D']);
    $preu = floatval($row['E']);
    $estoc = intval($row['F']);

    if (empty($nom) || $preu <= 0) continue;

    $productes[] = [
        "id" => $id++,
        "sku" => $sku,
        "nom" => $nom,
        "descripcio" => $descripcio,
        "img" => $img,
        "preu" => $preu,
        "estoc" => $estoc
    ];
}

// 🧾 Guardar JSON localmente
$data = ["productes" => $productes];
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$localCopy = '/var/www/html/../data/datos.json';
copy($jsonFile, $localCopy);
// 🔗 Enviar dades al JSON Server (opcional)
$jsonServerUrl = 'http://jsonserver:3005/productes';
$ch = curl_init($jsonServerUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($productes));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);
$response = curl_exec($ch);
curl_close($ch);

// Resultat
echo "<h2>Importació completada</h2>";
echo "<p>Total productes importats: " . count($productes) . "</p>";
echo "<p><a href='http://localhost:3005/productes' target='_blank'>Veure productes al JSON Server</a></p>";
echo "<p><a href='/data/datos.json' target='_blank'>Descarregar JSON local</a></p>";
