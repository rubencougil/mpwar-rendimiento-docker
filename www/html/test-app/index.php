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
 * | dependencies |
 * ----------------
 */
$db = new PDO('mysql:dbname=db;host=mysql', 'user', 'password');
$redis = new Redis();
$redis->connect('redis');
$connection = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq');
$elastic = (new ElasticaClient(['host' => 'elasticsearch', 'port' => 9200]));
$elastic->getVersion();

$dc = [
    'mysql' => $db,
    'redis' => $redis,
    'rabbitmq' => $connection,
    'elasticsearch' => $elastic
];

/*
 * -----------
 * | routing |
 * -----------
 */

// Add your URL routes here
$home  = new Route('/users/', ['controller' => UserController::class]);
$users = new Route('/',       ['controller' => HomeController::class]);

// ... and don't forget to add the route to the following collection
$routes = new RouteCollection();
$routes->add('home', $home);
$routes->add('users', $users);

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());
$matcher = new UrlMatcher($routes, $context);

try {
    $ctrlName = $matcher->match($context->getPathInfo())['controller'];
    $ctrl = new $ctrlName($dc);
    $response = $ctrl(Request::createFromGlobals());
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
}

$response->send();

