<?php

namespace Blog\Router;

class Route
{
    /** @var string to match against */
    private $path;
    /** @var string function to call*/
    private $callback;
    /** @var array request parameters */
    private $params;

    /**
     * Constructor
     * @param string        $path route's path
     * @param string        $callback function name
     * @param array         $params to pass to the callback function
     */
    public function __construct($path, $callback, $params = [])
    {
        $this->path = $this->normalize($path);
        $this->callback = $callback;
        $this->params = $params;
    }
    /**
     * Removes query string from uri and return an array without empty values
     *
     * @param string    $uri to be normalized
     * @return array    $route normalized
     * */
    private function normalize($uri)
    {
        //gets a clean uri
        $uri = parse_url($uri)['path'];
        //explodes it into an array
        $route = explode("/", $uri);
        
        return $route = array_values(array_filter($route));
    }

    /**
     * Handles the matching process
     * @param Request     $request to match agains
     */
    public function match(Request $request)
    {
        return $this->matchesPath($request->getUri())
                && $this->matchesParams($request->getParams());
    }

    /**
     * Matches request path against url path
     *
     * @param string        $rPath of the request
     * @return boolean
     */
    private function matchesPath($rPath)
    {
        $comparePath = $this->normalize($rPath);
        return empty(
            array_diff(
                $comparePath,
                $this->path
                )
            );
    }

    /**
     * Matches request params against route's required  params.
     * Initializes routes params if matched.
     *
     * @param string        $rParams of the request
     * @return boolean
     */
    private function matchesParams($rParams)
    {
        //merges the result of array_diff_keys to obtain uniques keys that exist only in either array but not in both
        $unique = array_merge(
            array_diff_key($rParams, $this->params),
            array_diff_key($this->params, $rParams)
        );
        $compareParams = empty($unique);

        if ($compareParams) {
            $this->params = $rParams;
        }

        return $compareParams;
    }

    /**
     * Calls the controller on the other side of the route
     */

    public function call()
    {
        $callback = explode('#', $this->callback);

        $controller = new $callback[0]();

        return call_user_func_array(array($controller, $callback[1]), $this->params);
    }

    /**
     * Get the value of path
     */
    public function getPath()
    {
        return $this->path;
    }
}
