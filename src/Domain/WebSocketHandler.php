<?php

declare(strict_types=1);

namespace App\Domain;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

final class WebSocketHandler implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn): void
    {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        echo "Message from {$from->resourceId}: $msg\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}