<?php

declare(strict_types=1);

namespace App\Domain;

use App\Infrastructure\Centrifugo\Response\ResponseInterface;

interface MessagesInterface
{
    public function publish(string $channel, array $data = []): ResponseInterface;

    public function broadcast(array $channels, array $data): ResponseInterface;

    public function presence(string $channel): ResponseInterface;

    public function presenceStats(string $channel): ResponseInterface;

    public function history(string $channel): ResponseInterface;

    public function historyRemove(string $channel): ResponseInterface;

    public function unsubscribe(string $channel, int $userId): ResponseInterface;

    public function disconnect(int $userId): ResponseInterface;

    public function channels(): ResponseInterface;

    public function info(): ResponseInterface;
}
