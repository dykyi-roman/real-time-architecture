<?php

declare(strict_types=1);

namespace App\Presentation\Console;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:rabbitmq:subscribe',
    description: 'Subscribe and read messages from RabbitMQ'
)]
final class RabbitMqSubscriberCommand extends Command
{
    public function __construct(
        private readonly string $rabbitMqHost,
        private readonly int $rabbitMqPort,
        private readonly string $rabbitMqUser,
        private readonly string $rabbitMqPassword
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = new AMQPStreamConnection(
            $this->rabbitMqHost,
            $this->rabbitMqPort,
            $this->rabbitMqUser,
            $this->rabbitMqPassword
        );
        $channel = $connection->channel();

        $channel->queue_declare('notification', false, true, false, false);

        $callback = function (AMQPMessage $msg) {
            // TODO: To do something with your message
            echo $msg->body . "\n";
        };

        $output->writeln('Waiting for messages. To exit press CTRL+C');
        $channel->basic_consume(
            'notification',
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

        return Command::SUCCESS;
    }
}