<?php

declare(strict_types=1);

namespace App\Presentation\Console;

use App\Domain\WebSocketHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:server:start',
    description: 'This is a start server command'
)]
final class WebSocketServerCommand extends Command
{
    protected static $defaultName = 'app:server:start';

    private const PORT = 8081;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Start the WebSocket server.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting WebSocket server...');
        $server = IoServer::factory(new HttpServer(
            new WsServer(
                new WebSocketHandler(),
            )
        ), self::PORT);

        $server->run();

        return Command::SUCCESS;
    }
}