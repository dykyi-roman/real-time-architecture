<?php

declare(strict_types=1);

namespace App\Presentation\Console;

use App\Domain\MessageProducerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:kafka:subscribe',
    description: 'This is a kafka subscriber command'
)]
final class KafkaSubscriberCommand extends Command
{
    public function __construct(
        private readonly MessageProducerInterface $messageProducer,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(
                'topic',
                InputArgument::REQUIRED,
                'The name of the Kafka topic to subscribe to',
                'chat'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting to subscribe ...');

        $this->messageProducer->consumeMessages(
            1000,
            [$input->getArgument('topic')],
            function (string $message): void {
                // TODO: To do something with your message
                echo $message . "\n";
            }
        );

        return Command::SUCCESS;
    }
}