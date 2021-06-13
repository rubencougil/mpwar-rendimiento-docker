<?php

namespace TestApp;

use Blackfire\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return new Response("hi {$request->attributes->get('id')}", 200);
    }

    public function create(Request $request): Response {
        return new Response("hi, create {$request->attributes->get('id')}", 200);
    }
}