<?php

require __DIR__.'/vendor/autoload.php';
require_once( __DIR__ . "/test/Blog/Router/Fixtures/TestController.php");

use Blog\Router\HttpRouter as Router;
use Blog\Router\Request;
use Blog\Router\Response;
use Blog\Router\Route;

$request = new Request($_SERVER['REQUEST_URI'], $_REQUEST);
$router = new Router();

$router->import(__DIR__. "/config/routes.yml");

//Trying to resolve request
$response = $router->resolve($request);

$response->send();
die();