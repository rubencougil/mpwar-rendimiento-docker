<?php

namespace Test;

use DateTimeInterface;
use Elastic\Elasticsearch\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ElasticsearchController extends BaseController
{
    public function __invoke(Request $request): Response {

        /* @var Client */
        $elasticsearch = $this->dc['elasticsearch'];

        try {

            $elasticsearch->index([
                'index' => 'test-index',
                'body' => [
                    'timestamp' => (new \DateTime())->format(DateTimeInterface::ATOM),
                    'name' => 'john',
                    'age'  => 20
                ]
            ]);

        } catch (\Exception $e) {
            return new Response("Error: {$e->getMessage()}", 500);
        }
        return new Response("Indexed a document in Elasticsearch! {$request->attributes->get('name')}", 200);
    }
}