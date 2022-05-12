<?php

namespace Test;

use Redis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RedisController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        $key = $request->attributes->get('key');
        $value = $request->attributes->get('value');

        /* @var Redis */
        $redis = $this->dc['redis'];
        $redis->set($key, $value);
        return new Response("Key: $key, Value: {$redis->get($key)}. Got from Redis!", 200);
    }
}