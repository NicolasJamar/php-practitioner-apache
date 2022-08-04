<?php

class Router
{
    protected $routes = [];

    public function define($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    public function direct($uri)
    {
        if(array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri];
        } else {
            return "Url doesn't exist.";
        }
    }
}