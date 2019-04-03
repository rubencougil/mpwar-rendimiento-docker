<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$db = new PDO('mysql:dbname=db;host=mysql', 'user', 'password');
$redis = (new Redis())->connect('redis');
$connection = new AMQPStreamConnection('rabbitmq', 5672, 'rabbitmq', 'rabbitmq');

echo 'Hello World!';
