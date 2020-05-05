<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Elastica\Client as ElasticaClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;

// If you add a new route don't forget to include it's namespace
use TestApp\UserController;
use TestApp\HomeController;

/*
 * ----------------
 * | Dependencies |
 * ----------------
 */
$mysql = new PDO('mysql:dbname=db;host=mysql', 'user', 'password');
$redis = new Redis();
$redis->connect('redis');
$rabbitmq = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq');
$elasticsearch = (new ElasticaClient(['host' => 'elasticsearch', 'port' => 9200]));
$elasticsearch->getVersion();

$dc = [
    'mysql' => $mysql,
    'redis' => $redis,
    'rabbitmq' => $rabbitmq,
    'elasticsearch' => $elasticsearch
];

/*
 * -----------
 * | Routing |
 * -----------
 */
// Add your URL routes here
$users = new Route('/',           ['controller' => HomeController::class]);
$home  = new Route('/users/{id}', ['controller' => UserController::class]);

// ... and don't forget to add the route to the following collection
$routes = new RouteCollection();
$routes->add('home', $home);
$routes->add('users', $users);

/*
 * ------------
 * | Dispatch |
 * ------------
 */
$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $attributes = $matcher->match($context->getPathInfo());
    $ctrlName = $matcher->match($context->getPathInfo())['controller'];
    $ctrl = new $ctrlName($dc);
    $response = $ctrl(Request::create(
        $context->getBaseUrl(),
        $context->getMethod(),
        $matcher->match($context->getPathInfo())
    ));
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
}

$response->send();
