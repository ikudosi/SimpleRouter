<?php

namespace Tests\Unit;

use Tests\TestCase;

class PatientsRouteTest extends TestCase
{
    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_it_shows_a_patients_list()
    {
        $response = $this->call("GET", "/patients");

        $this->assertTrue(count($response['data']) === 2);
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_it_shows_a_patient_resource()
    {
        $random_id = rand(1, 50);
        $response = $this->call("GET", "/patients/{$random_id}");

        $this->assertTrue(count($response['data']) === 1, "Data returned multiple resources");
        $this->assertTrue($response['data'][0]['id'] == $random_id, "Data did not contain the given id");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_it_creates_a_patient()
    {
        $patient_first = "Almighty";
        $patient_last = "Thor";

        $response = $this->call("POST", "/patients", [
            'first_name' => $patient_first,
            "last_name" => $patient_last
        ]);

        $this->assertTrue($response['text'] === "Successfully created patient {$patient_first} {$patient_last}");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_it_updates_a_patient_resource()
    {
        $random_id = rand(1, 50);

        $response = $this->call("PATCH", "/patients/{$random_id}", []);

        $this->assertTrue($response['text'] === "Successfully updated patient ID {$random_id}");
    }

    /**
     * @throws \App\Exceptions\HttpNotFoundException
     */
    public function test_it_deletes_a_patient()
    {
        $random_id = rand(1, 50);

        $response = $this->call("DELETE", "/patients/{$random_id}", []);

        $this->assertTrue($response['text'] === "Successfully deleted patient ID {$random_id}");
    }
}