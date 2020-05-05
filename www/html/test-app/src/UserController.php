<?php

namespace TestApp;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return Response::create("hi {$request->get('id')}", 200);
    }
}