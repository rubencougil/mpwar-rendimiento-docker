<?php

namespace Test;

use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MySqlController extends BaseController
{
    public function __invoke(Request $request): Response {

        /* @var PDO */
        $pdo = $this->dc['mysql'];

        $pdo->query("SELECT SLEEP(2)");
        return new Response("Executed a very slow query in MySQL! {$request->attributes->get('name')}", 200);
    }
}