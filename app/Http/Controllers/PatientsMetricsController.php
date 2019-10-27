<?php

namespace App\Http\Controllers;

use App\Http\Foundation\Request;

class PatientsMetricsController
{
    public function index(Request $request, $patient_id)
    {
        return [
            'data' => [
                'id' => $patient_id,
                'first_name' => 'Tony',
                'last_name' => 'Starks',
                'metrics' => [
                    [
                        'id' => 1,
                        'heart_beat' => '90bpm'
                    ],
                    [
                        'id' => 2,
                        'last_visit' => '2019-10-21 09:10:20'
                    ]
                ]
            ]
        ];
    }

    public function get(Request $request, $patient_id, $metricId)
    {
        return [
            'data' => [
                'id' => $patient_id,
                'first_name' => 'Tony',
                'last_name' => 'Starks',
                'metrics' => [
                    [
                        'id' => $metricId,
                        'last_visit' => '2019-10-21 09:10:20'
                    ]
                ]
            ]
        ];
    }

    public function create(Request $request, $patient_id)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully created a patient metric for patient ID {$patient_id}."
        ];
    }

    public function update(Request $request, $patient_id, $metric_id)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully updated metric ID {$metric_id} for patient ID {$patient_id}",
        ];
    }

    public function delete(Request $request, $patient_id, $metric_id)
    {
        // Pretend we did a simple database call

        return [
            'text' => "Successfully deleted metric ID {$metric_id} for patient ID {$patient_id}"
        ];
    }
}