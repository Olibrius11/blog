<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Blog\Router\HttpRouter as Router;
use Blog\Router\Request;

//P5 - Blog\blog\vendor\bin>phpunit ../../test/Blog/Router/HttpRouterTest --testdox

final class HttpRouterTest extends TestCase
{

    /**
     * Testing import()
     */

    public function testCanImportRoutesFromFile ()
    {
        $router = new Router();
        $router->import( __DIR__ . "/Fixtures/testroutes.yml");
        $this->assertNotNull($router->getRoutes()); 
    }

    public function testCanResolveSimpleRoute()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");
        $router = new Router();
        $router->import( __DIR__ . "/Fixtures/testroutes.yml");

        $request = new Request ("blog/admin");

        $this->assertEquals($router->resolve($request)->getContent(), "received");

    }

    public function testCanResolveRouteWithOneParam()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");

        $router = new Router();
        $router->import( __DIR__ . "/Fixtures/testroutes.yml");

        $request = new Request ("blog/admin/food");
        $request->setParams(array("food"=>"banana"));
        $this->assertEquals($router->resolve($request)->getContent(), "banana");

    }

    public function testCanResolveRouteWithMoreThanOneParam()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");

        $router = new Router();
        $router->import( __DIR__ . "/Fixtures/testroutes.yml");

        $request = new Request ("blog/food/details");
        $request->setParams(array(
            "food"=>"banana",
            "color"=> "yellow",
            "quantity" => "enormous"
        ));
        $this->assertEquals($router->resolve($request)->getContent(), "You love enormous piece(s) of yellow banana");
        
    }

    public function test404OnRouteWithoutRequiredParams()
    {
        require_once( __DIR__ . "/Fixtures/TestController.php");

        $router = new Router();
        $router->import( __DIR__ . "/Fixtures/testroutes.yml");

        $request = new Request ("blog/admin/food");
        $request->setParams(array(
            "willfail"=>"there"
        ));
        $this->assertEquals($router->resolve($request)->getStatus(), 404);
    }
       

}