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
    }

    /**
     * @param  Request  $request
     * @return Response
     * @throws HttpNotFoundException
     */
    public function handle(Request $request)
    {
        $routing_data = Router::getInstance()->getActionByUrl($request->server['REQUEST_METHOD'], $request->server['REQUEST_URI']);

        if (is_null($routing_data)) {
            throw new HttpNotFoundException;
        }

        if (is_callable($routing_data->url_action)) {
            return new Response($routing_data->url_action->__invoke($request, ...$routing_data->url_params));
        }

        if (is_string($routing_data->url_action)) {
            $action = explode("@", $routing_data->url_action);
            return new Response( (new $action[0])->{$action[1]}($request, ...$routing_data->url_params) );
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