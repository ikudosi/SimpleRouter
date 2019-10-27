<?php

namespace Tests;

use App\Http\Foundation\Application;
use App\Http\Foundation\Request;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Application */
    protected $app = null;

    /**
     * Fire the app
     */
    protected function setUp(): void
    {
        if (!$this->app) {
            $this->app = require __DIR__.'/../bootstrap/app.php';
        }
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        if ($this->app) {
            $this->app = null;
        }
    }

    /**
     * @param $method
     * @param $uri
     * @param  array  $parameters
     * @param  bool  $decoded
     * @return mixed
     * @throws \App\Exceptions\HttpNotFoundException
     */
    protected function call($method, $uri, $parameters = [], $decoded = true)
    {
        $method = strtoupper($method);

        $response = $this->app->handle(
            Request::createRequestFromFactory(
                $method === "GET" ? $parameters : [],
                $method === "POST" ? $parameters : [],
                [],
                [
                    'REQUEST_METHOD' => $method,
                    'REQUEST_URI' => $uri[0] !== "/" ? "/".$uri : $uri
                ]
            ))->getContent();

        return $decoded ? json_decode($response, true) : $response;
    }
}