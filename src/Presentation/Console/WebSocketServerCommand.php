<?php

declare(strict_types=1);

namespace App\Presentation\Console;

use App\Infrastructure\WebSocket\WebSocketHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:websocket:start',
    description: 'This is a start server command'
)]
final class WebSocketServerCommand extends Command
{
    public function __construct(
        private readonly string $websocketServerPort,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting WebSocket server...');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketHandler(),
                )
            ),
            $this->websocketServerPort,
        );

        $server->run();

        return Command::SUCCESS;
    }
}