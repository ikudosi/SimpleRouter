<?php

namespace App\Http\Controllers;

use App\Http\Foundation\Request;

class PatientsController
{
    public function index(Request $request)
    {
        return [
            'data' => [
                [
                    'first_name' => 'Tony',
                    'last_name' => 'Starks',
                ],
                [
                    'first_name' => 'Steve',
                    'last_name' => 'Rogers',
                ]
            ]
        ];
    }

    public function get(Request $request, $patient_id)
    {
        return [
            'data' => [
                [
                    'id' => $patient_id,
                    'first_name' => 'Steve',
                    'last_name' => 'Rogers',
                ]
            ]
        ];
    }

    public function create(Request $request)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully created patient {$request->get("first_name")} {$request->get("last_name")}"
        ];
    }

    public function update(Request $request, $patient_id)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully updated patient ID {$patient_id}",
        ];
    }

    public function delete(Request $request, $patient_id)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully deleted patient ID {$patient_id}"
        ];
    }
}