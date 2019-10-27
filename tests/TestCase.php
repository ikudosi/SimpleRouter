<?php

namespace Tests;

use App\Http\Foundation\Application;
use App\Http\Foundation\Request;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Application */
    protected $app;

    /**
     * Fire the app
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (!$this->app) {
            $this->app = include __DIR__.'/../bootstrap/app.php';
        }
    }

    /**
     * @param $method
     * @param $uri
     * @param  array  $parameters
     * @return mixed
     * @throws \App\Exceptions\HttpNotFoundException
     */
    protected function call($method, $uri, $parameters = [])
    {
        $method = strtoupper($method);

        return $this->app->handle(
            Request::createRequestFromFactory(
                $method === "GET" ? $parameters : [],
                $method === "POST" ? $parameters : [],
                [],
                [
                    'REQUEST_METHOD' => $method,
                    'REQUEST_URI' => $uri[0] !== "/" ? "/".$uri : $uri
                ]
            ))->getContent();
    }
}