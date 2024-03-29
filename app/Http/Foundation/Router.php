<?php

namespace App\Http\Foundation;

class Router
{
    protected static $instance;

    protected $get = [];

    protected $post = [];

    protected $put = [];

    protected $patch = [];

    protected $delete = [];

    public $url_action;

    public $url_params = [];

    protected function __construct() {}

    /**
     * @param  string  $uri
     * @param $target
     * @return Router
     */
    public static function get(string $uri, $target)
    {
        return static::setRoute("GET", $uri, $target);
    }

    /**
     * @param  string  $uri
     * @param $target
     * @return Router
     */
    public static function post(string $uri, $target)
    {
        return static::setRoute("POST", $uri, $target);
    }

    /**
     * @param  string  $uri
     * @param $target
     * @return Router
     */
    public static function put(string $uri, $target)
    {
        return static::setRoute('PUT', $uri, $target);
    }

    /**
     * @param  string  $uri
     * @param $target
     * @return Router
     */
    public static function patch(string $uri, $target)
    {
        return static::setRoute('PATCH', $uri, $target);
    }

    /**
     * @param  string  $uri
     * @param $target
     * @return Router
     */
    public static function delete(string $uri, $target)
    {
        return static::setRoute('DELETE', $uri, $target);
    }

    /**
     * @return Router
     */
    public static function getInstance(): self
    {
        if (!static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * @param $method
     * @param $url
     * @return mixed
     */
    public static function determineResponseActionByUrl($method, $url)
    {
        $instance = static::getInstance();

        /*
         * The concept of this is to iterate through the collection of routes on the supplied request method.
         * On each iteration, it will compare each segment of the current iteration's url vs requested url.
         * If no match is given then this method returns a null.
         */

        foreach ($instance->routeGenerator($method) as $route_url => $action) {

            $instance->url_action = null;
            $instance->url_params = [];

            $explodedUrlArgument = explode("/", substr($url, 1));
            $explodedRouteUrl = explode("/", substr($route_url, 1));

            $lengthArr1 = count($explodedUrlArgument);
            $lengthArr2 = count($explodedRouteUrl);

            // First compare that both url segments are equal in length
            if ($lengthArr1 !== $lengthArr2) {
                continue;
            }

            $isSame = true;

            // Loop through both arrays and compare
            for ($i = 0; $i < $lengthArr2; $i++) {

                if ($explodedUrlArgument[$i] === $explodedRouteUrl[$i] || $explodedRouteUrl[$i][0] === "{") {

                    // Check to see if current segment of url being parsed is a dynamic var if its wrapped in {}
                    if ($explodedRouteUrl[$i][0] === "{" && $explodedRouteUrl[$i][strlen($explodedRouteUrl[$i])-1] === "}") {

                        // Assign this value as a url param so it can be injected to the callable
                        $instance->url_params[] = $explodedUrlArgument[$i];
                    }

                    continue;
                } else {
                    $isSame = false;
                    break;
                }
            }

            // If we've made it this far then it seems we've found our first compatible url
            if ($isSame) {

                // Store the callable / controller@method
                $instance->url_action = $action;

                return $instance;
            }
        }

        return null;
    }

    /**
     * Uses PHP generators to iterate through the given route method
     *
     * @param $method
     * @return \Generator
     */
    public function routeGenerator($method)
    {
        foreach ($this->{strtolower($method)} as $url => $action) {
            yield $url => $action;
        }
    }

    /**
     * @param  string  $file
     */
    public static function loadRouteFiles($file = "")
    {
        if (!$file) {
            return;
        }

        include_once __DIR__."/../../../routes/{$file}";
    }

    /**
     * @param $method
     * @param $uri
     * @param $target
     * @return Router
     */
    protected static function setRoute($method, $uri, $target)
    {
        $instance = static::getInstance();

        $uri = trim($uri);

        $instance->{strtolower($method)}[$uri[0] !== "/" ? "/".$uri : $uri] = $target;

        return $instance;
    }
}