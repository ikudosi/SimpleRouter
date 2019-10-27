<?php

namespace App\Http\Foundation;

use App\Exceptions\HttpException;
use App\Exceptions\HttpNotFoundException;

/**
 * Class Application
 * @package App\Http\Foundation
 */
class Application
{
    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->bootstrap();
    }

    /**
     * Nothing special other than initializing
     */
    public function bootstrap()
    {
        $this->mapRoutes();
    }

    /**
     * Loads files within the routes directory
     */
    public function mapRoutes()
    {
        Router::loadRouteFiles("web.php");
        Router::loadRouteFiles('patients.php');
    }

    /**
     * @param  Request  $request
     * @return Response
     * @throws HttpNotFoundException
     */
    public function handle(Request $request)
    {
        $response = Router::determineResponseActionByUrl($request->server['REQUEST_METHOD'], $request->server['REQUEST_URI']);

        if (is_null($response)) {
            throw new HttpNotFoundException;
        }

        if (is_callable($response->url_action)) {
            return new Response($response->url_action->__invoke($request, ...$response->url_params));
        }

        if (is_string($response->url_action)) {
            $action = explode("@", $response->url_action);
            return new Response( (new $action[0])->{$action[1]}($request, ...$response->url_params) );
        }
    }

    /**
     * @param $code
     * @param  string  $message
     * @throws HttpException
     * @throws HttpNotFoundException
     */
    public function abort($code, $message = '')
    {
        if ($code === 404) {
            throw new HttpNotFoundException;
        }

        throw new HttpException;
    }
}