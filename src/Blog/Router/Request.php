<?php

/*
 * This file is part of P5 - OPCR Blog package.
 *
 * (c) Vincent Lemire <v.lemire@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Blog\Router;

class Request
{
    /** @var string uri requested */
    private $uri;
    /** @var array request params  */
    private $params;

    /**
     * Constructor
     * Prepare a request for matching against routes 
     * 
     * @param string    $uri of the request
     * @param array     $params of the request
     * 
     * */
    public function __construct($uri = "", $params = [])
    {
        $this->uri = $uri;
        $this->params = $params;
    }


    /**
     * Get the value of uri
     */
    public function getUri()
    {
        return $this->uri;
    }
    /**
     * Get the value of params
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Set the value of params
     *
     * @return  self
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }
}
