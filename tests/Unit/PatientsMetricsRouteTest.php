<?php

namespace Tests\Unit;

use Tests\TestCase;

class PatientsMetricsRouteTest extends TestCase
{
    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_patient_metrics_is_displayed()
    {
        $random_id = rand(1,50);

        $response = $this->call('GET', "/patients/{$random_id}/metrics");

        $this->assertEquals($response['data']['id'], $random_id);
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_patient_metrics_by_id_is_displayed()
    {
        $random_id = rand(1,50);
        $random_metric_id = rand(1, 50);

        $response = $this->call('GET', "/patients/{$random_id}/metrics/{$random_metric_id}");

        $this->assertEquals($response['data']['id'], $random_id);
        $this->assertEquals($response['data']['metrics'][0]['id'], $random_metric_id);
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_a_patient_metrics_was_created()
    {
        $random_id = rand(1,50);

        $response = $this->call('POST', "/patients/{$random_id}/metrics");

        $this->assertEquals($response['text'], "Successfully created a patient metric for patient ID {$random_id}.");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_a_patient_metrics_was_updated()
    {
        $patient_id = rand(1,50);
        $metric_id = rand(1, 50);

        $response = $this->call('PATCH', "/patients/{$patient_id}/metrics/{$metric_id}");

        $this->assertEquals($response['text'], "Successfully updated metric ID {$metric_id} for patient ID {$patient_id}");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_a_patient_metrics_deleted()
    {
        $patient_id = rand(1,50);
        $metric_id = rand(1, 50);

        $response = $this->call('DELETE', "/patients/{$patient_id}/metrics/{$metric_id}");

        $this->assertEquals($response['text'], "Successfully deleted metric ID {$metric_id} for patient ID {$patient_id}");
    }
}