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

Router::get("/api/v1/test/show/text", \App\Http\Controllers\SampleController::class."@displayText");
Router::post("/api/v1/test/post", \App\Http\Controllers\SampleController::class."@store");