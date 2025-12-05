<?php
function json_get($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

function json_post($url, $data) {

    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // Esto permite leer respuesta aunque sea error
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Capturar código de respuesta (200, 201, 404…)
    $httpCode = null;
    if (isset($http_response_header[0])) {
        preg_match('{HTTP\/\S*\s(\d{3})}', $http_response_header[0], $match);
        $httpCode = $match[1];
    }

    return [
        "response" => json_decode($response, true),
        "http_code" => $httpCode,
        "raw" => $response
    ];
}


function json_patch($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}
?>
