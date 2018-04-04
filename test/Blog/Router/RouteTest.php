<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Blog\Router\Route;
use Blog\Router\Request;

//...\vendor\bin> phpunit ../../test/Blog/Router/RouteTest --testdox
final class RouteTest extends TestCase
{    
        /** Testing Resquest->Normalize */
        public function testKnowsHowToNormalizeSimpleUri()
        {
            $path= "/blog/admin/stuff";
            $route = new Route($path, "dummy");
            $this->assertEquals($route->getPath(), array("blog", "admin", "stuff"));
        }
    
       public function testKnowsHowToNormalizeUriWithGetParams()
        {
            $path = "blog/post/?id=123&title=dummy";
            $route = new Route($path, "dummy");
            $this->assertEquals($route->getPath(), array("blog", "post"));
        } 
    
    /** Testing Route->match() */
    public function testMatchesSimpleRoutes()
    {
        $request = new Request("/blog/admin/stuff");

        $route = new Route("/blog/admin/stuff", "dummy");

        $this->assertTrue($route->match($request));
    }

    public function testMatchesRoutesWithGetParams()
    {
        $request = new Request("/blog/admin/stuff?id=123&title=dummy", array("id"=>"123", "title"=>"dummy"));

        $route = new Route("/blog/admin/stuff", "dummy", array("id"=>"", "title"=>""));

        $this->assertTrue($route->match($request));
    }

    public function testDeclinesUndeclaredRoutes()
    {
        $request = new Request("/blog/admin/stuff?id=123&title=dummy");

        $route = new Route("/blog/admin/", "dummy");

        $this->assertEquals($route->match($request), false);

    }

    public function testCanResolveSimpleCall ()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");
        $route = new Route ("blog/post/", 'Blog\Test\TestController#received');

        $this->assertEquals($route->call(), "received");

    }

    public function testCanResolveCallWithParameters ()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");
        $route = new Route ("blog/post/", 'Blog\Test\TestController#favouriteFood', array("id"=>"banana"));
        
        $this->assertEquals($route->call(), "banana");
    }

}