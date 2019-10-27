<?php

use App\Http\Foundation\Router;

Router::get('/patients', \App\Http\Controllers\PatientsController::class."@index");
Router::get('/patients/{id}', \App\Http\Controllers\PatientsController::class.'@get');
Router::post('/patients', \App\Http\Controllers\PatientsController::class.'@create');
Router::patch('/patients/{id}', \App\Http\Controllers\PatientsController::class.'@update');
Router::delete('/patients/{id}', \App\Http\Controllers\PatientsController::class.'@delete');

Router::get('/patients/{id}/metrics', \App\Http\Controllers\PatientsMetricsController::class."@index");
Router::get('/patients/{id}/metrics/{metricId}', \App\Http\Controllers\PatientsMetricsController::class.'@get');
Router::post('/patients/{id}/metrics', \App\Http\Controllers\PatientsMetricsController::class.'@create');
Router::patch('/patients/{id}/metrics/{metricId}', \App\Http\Controllers\PatientsMetricsController::class.'@update');
Router::delete('/patients/{id}/metrics/{metricId}', \App\Http\Controllers\PatientsMetricsController::class.'@delete');