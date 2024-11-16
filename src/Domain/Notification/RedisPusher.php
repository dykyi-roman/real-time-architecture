<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use App\Infrastructure\Redis\RedisSubscriber;

final readonly class RedisPusher
{
    public function __construct(
        private PayloadGenerator $payload,
        private RedisSubscriber $redisSubscriber,
    ) {
    }

    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(function (int $count): void {
            $i = 1;
            while ($i <= $count) {
                $this->redisSubscriber->publishMessage('messages', $this->payload->generateRequest());
                $i++;
            }
        }, $count);
    }
}