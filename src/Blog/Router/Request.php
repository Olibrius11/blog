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
    /** uri requested */
    private $uri;
    /** request params  */
    private $params;

    /**Prepare a request for matching against routes */
    public function __construct ($uri="", $params=[])
    {
        $this->uri = $uri;
        $this->params = $params;
    }
    
    /**
     * Get the value of params
     */ 
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Get the value of uri
     */ 
    public function getUri()
    {
        return $this->uri;
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