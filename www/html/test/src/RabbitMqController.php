<?php

namespace Test;

use JsonException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RabbitMqController extends BaseController
{
    public const EXCHANGE = "test-exchange";
    public const QUEUE = "tests-queue";

    /**
     * @throws JsonException
     */
    public function __invoke(Request $request): Response {

        /* @var AMQPStreamConnection */
        $rabbitmq = $this->dc['rabbitmq'];
        $ch = $rabbitmq->channel();

        $ch->exchange_declare(self::EXCHANGE, "fanout", false, true, false);
        $ch->queue_declare(self::QUEUE, false, true, false, false);
        $ch->queue_bind(self::QUEUE, self::EXCHANGE);

        $msg = new AMQPMessage(json_encode(["message" => "test"], JSON_THROW_ON_ERROR));
        $ch->basic_publish($msg, self::EXCHANGE);

        $msg = $ch->basic_consume(self::QUEUE, "", false, false, false, false, static function(AMQPMessage $msg) {
            print_r("Msg: {$msg->getBody()}. Got from RabbitMQ!");
            $msg->ack();
        });

        $ch->close();
        return new Response("Msg: $msg. Got from RabbitMQ!", 200);
    }
}