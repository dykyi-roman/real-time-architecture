<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final readonly class RabbitMQPusher
{
    public function __construct(
        private PayloadGenerator $payload,
        private string $rabbitMqHost,
        private string $rabbitMqPort,
        private string $rabbitMqUser,
        private string $rabbitMqPassword,
    ) {
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(
            function (int $count): void {
                $connection = new AMQPStreamConnection(
                    $this->rabbitMqHost,
                    $this->rabbitMqPort,
                    $this->rabbitMqUser,
                    $this->rabbitMqPassword,
                );
                $channel = $connection->channel();

                $i = 1;
                while ($i <= $count) {
                    $msg = new AMQPMessage($this->payload->generateRequest());
                    $channel->basic_publish($msg, '', 'notification');
                    $i++;
                }

                $channel->close();
                $connection->close();
            }, $count
        );
    }
}
