<?php

declare(strict_types=1);

namespace App\Domain;

interface MessageProducerInterface
{
    public function sendMessage(string $topicName, string $message): void;

    public function consumeMessages(int $timeoutMs, array $topics, callable $callback): void;
}