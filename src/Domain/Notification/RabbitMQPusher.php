<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitMQPusher
{
    private const KEY = 'notification';

    /**
     * Variable
     *
     * @var PayloadGenerator |
     */
    private $payload;

    /**
     * SymfonyPusherDomain constructor.
     *
     * @param PayloadGenerator $payload
     */
    public function __construct(PayloadGenerator $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        $startTime = microtime(true);

        $connection = new AMQPStreamConnection(
            $_SERVER['RABBIT_MQ_HOST'],
            $_SERVER['RABBIT_MQ_PORT'],
            $_SERVER['RABBIT_MQ_USER'],
            $_SERVER['RABBIT_MQ_PASSWORD']
        );
        $channel = $connection->channel();

        $i = 1;
        while ($i <= $count) {
            $msg = new AMQPMessage($this->payload->generateRequest());
            $channel->basic_publish($msg, '', self::KEY);
            $i++;
        }

        $channel->close();
        $connection->close();

        return new OperationTime($startTime, microtime(true));
    }
}
