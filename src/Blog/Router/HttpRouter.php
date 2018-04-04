<?php
namespace Blog\Router;

/** Imports */
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Blog\Router\Request;
use Blog\Router\Response;

class HttpRouter 
{
    /**@var array An array representing routes and their associated controllers */
    private $routes;
 
    /**
     * Imports routes from a config file.
     * 
     * @param string    $file Path to the config file
     * 
     * @return array    $routes couples of routes and controller names
     */
    public function import (string $file)
    {
        try {
            $routes = Yaml::parseFile($file);
            foreach ($routes as $route)
            {
                if(!isset($route["params"]) || empty($route["params"])) {
                    $this->addRoute(new Route($route["path"], $route['callback'], [])); 
                    continue;
                }
                
                if (is_array($route["params"])) {
                    $this->addRoute (new Route($route["path"], $route['callback'], array_fill_keys($route["params"], "")));
                    continue;
                }
                    $this->addRoute (new Route($route["path"], $route['callback'], [$route["params"]=>""])); 
              
            };
        } catch (ParseException $e) {
            sprintf("Error parsing file %s near : \n %s", $e->getParsedFile(), $e->getSnippet());
        }
    }

    /** 
     * Resolves route from request
     * 
     * @param Request       Request to resolve
     * @return              Response givent by the resolved controller
     */

     public function resolve(Request $request)
     {
         foreach($this->routes as $route) {
             if ($route->match($request)) {
                 return new Response (202, $route->call());
             }
         }
         
         return new Response(404, "Route not Found");
     }

     /**
      * Adds a route to Router
      * @param Route    $route
      */
     public function addRoute (Route $route)
     {
         $this->routes [] = $route;
     }

    /**
     * Returns the value of routes
     */
    public function getRoutes ()
    {
        return $this->routes;
    }

}
