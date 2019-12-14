<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Elastica\Client as ElasticaClient;

$db = new PDO('mysql:dbname=db;host=mysql', 'user', 'password');
$redis = (new Redis())->connect('redis');
$connection = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq');
$elastic = (new ElasticaClient(['host' => 'elasticsearch', 'port' => 9200]));
$elastic->getVersion();

echo 'Hello World!';
