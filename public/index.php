<?php

/*
|-----------------------------------------
| Auto load the vendor dependencies
|-----------------------------------------
*/

require __DIR__.'/../vendor/autoload.php';

/*
|-----------------------------------------
| Call our main app script and return it
|-----------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|-----------------------------------------
| Make it rain
|-----------------------------------------
*/

$response = $app->handle(
    \App\Http\Foundation\Request::createFromGlobals()
);

$response->send();

