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

class Response 
{
    private $status;
    private $content;

    public function __construct (int $status=200, $content="")
    {
        $this->status = $status;
        $this->content = $content;
    }

    /**
     * Sends response to browser
     * 
     * @param int       $code for http response
     */ 

    public function send($code=200)
    {
        http_response_code($this->status);
        echo $this->content;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}