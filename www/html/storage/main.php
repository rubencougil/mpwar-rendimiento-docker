<?php

namespace Storage;

require_once __DIR__ . '/vendor/autoload.php';

// with cache
$withCache = new Storage(new MySql(), new Redis());
$withCache->get('ruben');

// without cache
$withoutCache = new Storage(new MySql(), new NullCache());
$withoutCache->get('ruben');
