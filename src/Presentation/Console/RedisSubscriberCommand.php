<?php

declare(strict_types=1);

namespace App\Presentation\Console;

use App\Infrastructure\Redis\RedisSubscriber;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:redis:subscribe',
    description: 'This is a redis subscriber command'
)]
final class RedisSubscriberCommand extends Command
{
    public function __construct(
        private readonly RedisSubscriber $redisPubSubPusher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'channel',
                InputArgument::REQUIRED,
                'The name of the Redis channel to subscribe to',
                'messages',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting to subscribe ...');

        $this->redisPubSubPusher->subscribe(
            $input->getArgument('channel'),
            function ($message) {
                // TODO: To do something with your message
                echo $message . "\n";
            }
        );

        return Command::SUCCESS;
    }
}