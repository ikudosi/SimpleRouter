<?php

use App\Http\Foundation\Router;
use \App\Http\Foundation\Request;

Router::get("/api/v1/user/{id}/address/{addressId}", function (Request $request, $id, $addressId) {
    return [
        "data" => [
            [
                'type' => 'users',
                'id' => $id,
                'first_name' => 'Tony',
                'last_name' => 'Starks',
                'address_id' => $addressId
            ]
        ]
    ];
});

Router::get("/api/v1/sample-text", \App\Http\Controllers\SampleTextController::class."@index");

Router::get("/api/v1/test", \App\Http\Controllers\SampleController::class."@index");
Router::post("/api/v1/post-test", \App\Http\Controllers\SampleController::class."@store");