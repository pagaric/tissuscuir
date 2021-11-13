<?php

namespace App\Routes;

/**
 * Cette classe Router va stocker les routes dans un tableau
 */
class Router
{

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct(string $url)
    {
        $this->url = trim($url, '/');
    }

    private function addRoute($method, $path, $action, $name)
    {
        $route = new Route($path, $action);
        $this->routes[$method][] = $route;
        if($name) {
            $this->namedRoutes[$name] = $path;
        }
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array|string $action
     * @return void
     */
    public function get(string $path, $action, $name = null)
    {
        // $this->routes['GET'][] = new Route($path, $action);
        $this->addRoute('GET', $path, $action, $name);
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array|string $action
     * @return void
     */
    public function post(string $path, $action, $name = null)
    {
        // $this->routes['POST'][] = new Route($path, $action);
        $this->addRoute('POST', $path, $action, $name);
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array|string $action
     * @return void
     */
    public function put(string $path, $action, $name = null)
    {
        // $this->routes['PUT'][] = new Route($path, $action);
        $this->addRoute('PUT', $path, $action, $name);
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array|string $action
     * @return void
     */
    public function delete(string $path, $action, $name = null)
    {
        // $this->routes['DELETE'][] = new Route($path, $action);
        $this->addRoute('DELETE', $path, $action, $name);
    }

    public function run()
    {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->matches($this->url)) {
                return $route->execute();
            }
        }
        return header('HTTP/1.0 404 Not Found');
    }

    public function getPathNamedRoute($name)
    {
        return $this->namedRoutes[$name];
    }

}