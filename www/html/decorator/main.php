<?php

use Decorator\CacheDecorator;
use Decorator\Component;

require_once __DIR__ . '/vendor/autoload.php';

$component = new Component();
echo "Client: I've got a simple component\n";
$component->operation();

$componentWithCache = new CacheDecorator($component);
echo "Client: Now I've got a decorated component:\n";
$componentWithCache->operation();
