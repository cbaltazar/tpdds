#!/usr/bin/php
<?php

if (!isset($argv[1])) {
    echo "\nMissing accounts file.\n";
} else {
    $data = new stdClass();
    $data->fileName = $argv[1];

    // Creo el header para el request.
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Authorization: application/json\r\n" .
                "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        )
    ));

// envio el posts.
    $response = file_get_contents('http://localhost:8000/api/store', FALSE, $context);

// valido si estuvo todo bien.
    if ($response === FALSE) {
        die('Error loading accounts.');
    } else {
        echo "\nAccounts loaded!\n";
    }

}


?>