#!/usr/bin/php
<?php

require __DIR__ . '/../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use \App\Model\Entities\User;
use \App\Model\Entities\Empresa;
use \App\Model\Entities\Cuenta_Empresa;

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
        die('Error al cargar el archivo de cuentas.');
    } else {
        echo "\nCuentas actualizadas!\n";
        echo "\nCalculando indicadores...\n";

        //{"company":"70","period":"2013","user_id":"4"};
        $users = User::all();
        Cache::flush();
        foreach ($users as $user) {
            $companies = Empresa::all();
            foreach ($companies as $company) {
                $rows = Cuenta_Empresa::where("empresa_id", $company->getId())->get();
                foreach ($rows as $row) {
                    $request = new stdClass();
                    $request->company = $company->getId();
                    $request->period = $row->periodo;
                    $request->user_id = $user->id;

                    // Creo el header para el request.
                    $context = stream_context_create(array(
                        'http' => array(
                            'method' => 'POST',
                            'header' => "Authorization: application/json\r\n" .
                                "Content-Type: application/json\r\n",
                            'content' => json_encode($request)
                        )
                    ));

                    // envio el posts.
                    $response = file_get_contents('http://localhost:8000/api/indicatorEvaluate', FALSE, $context);

                    if( $response ){
                        $cacheKey = $company->getId().$row->periodo.$user->id;
                        \Cache::put($cacheKey, $response, 43200);
                    }
                }
            }
        }
    }

}


?>