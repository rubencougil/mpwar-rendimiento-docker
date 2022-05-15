<?php

namespace Test;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    public function get(Request $request): Response {
        return new Response("hi, {$request->attributes->get('name')}", 200);
    }
}