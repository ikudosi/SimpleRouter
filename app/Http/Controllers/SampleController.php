<?php

namespace App\Http\Controllers;

use App\Http\Foundation\Request;

class SampleController
{
    public function index(Request $request)
    {
        return [
            "text" => "Wow. Much impress!",
            "data" => [
                'foo' => 'bar?'
            ]
        ];
    }

    public function store(Request $request)
    {
        return $request->request;
    }

    public function displayText(Request $request)
    {
        return "Everything is awesome!";
    }
}