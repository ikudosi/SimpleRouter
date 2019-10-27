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
    public function getActionByUrl($method, $url)
    {
        foreach ($this->routeGenerator($method) as $route_url => $action) {

            $explodedUrlArgument = explode("/", substr($url, 1));
            $explodedRouteUrl = explode("/", substr($route_url, 1));

            $lengthArr1 = count($explodedUrlArgument);
            $lengthArr2 = count($explodedRouteUrl);

            // First check if the counts are not equal as then they are not same potential URL
            if ($lengthArr1 !== $lengthArr2) {
                continue;
            }

            $isSame = true;

            // Loop through both arrays and compare
            for ($i = 0; $i < $lengthArr2; $i++) {

                if ($explodedUrlArgument[$i] === $explodedRouteUrl[$i] || $explodedRouteUrl[$i][0] === "{") {

                    // Check to see if current segment of url being parsed is a dynamic var if its wrapped in {}
                    if ($explodedRouteUrl[$i][0] === "{" && $explodedRouteUrl[$i][strlen($explodedRouteUrl[$i])-1]) {

                        // Assign this value as a url param so it can be injected to the callable
                        $this->url_params[] = $explodedUrlArgument[$i];
                    }

                    continue;
                } else {
                    $isSame = false;
                    $this->url_params = [];
                }
            }

            // If we've made it this far then it seems we've found our first compatible url
            if ($isSame) {

                // Store the callable / controller@method
                $this->url_action = $action;

                return $this;
            }
        }

        return null;
    }

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

        $instance->{strtolower($method)}[$uri[0] !== "/" ? "/".$uri : $uri] = $target;

        return $instance;
    }
}