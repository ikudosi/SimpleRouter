<?php

namespace App\Http\Controllers;

use App\Http\Foundation\Request;

class SampleTextController
{
    public function index(Request $request)
    {
        return "Everything is awesome!";
    }
}