<?php

declare(strict_types=1);

namespace App\Domain;

use Predis\Client;

final readonly class RedisSubscriber
{
    private Client $redis;

    public function __construct(string $redisUrl)
    {
        $this->redis = new Client($redisUrl);
    }

    public function publishMessage(string $channel, string $message): void
    {
        $this->redis->publish($channel, $message);
    }

    public function publishMessages(string $channel, array $messages): void
    {
        foreach ($messages as $message) {
            $this->publishMessage($channel, $message);
        }
    }

    public function subscribe(string $channel, callable $callback): void
    {
        $pubSub = $this->redis->pubSubLoop();
        $pubSub->subscribe($channel);

        foreach ($pubSub as $message) {
            if ($message->kind === 'message') {
                $callback($message->payload);
            }
        }
    }
}