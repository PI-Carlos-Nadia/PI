<?php

function json_get($endpoint) {
    $url = "http://jsonserver:3005/" . $endpoint;
    return json_decode(file_get_contents($url), true);
}

function json_post($endpoint, $data) {
    $url = "http://jsonserver:3005/" . $endpoint;
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        ]
    ];
    $context  = stream_context_create($options);
    return json_decode(file_get_contents($url, false, $context), true);
}

function json_patch($endpoint, $data) {
    $url = "http://jsonserver:3005/" . $endpoint;
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'PATCH',
            'content' => json_encode($data)
        ]
    ];
    $context  = stream_context_create($options);
    return json_decode(file_get_contents($url, false, $context), true);
}
