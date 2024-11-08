<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Predis\Client;

final readonly class RedisPubSubDomain
{
    private const KEY = 'notification-pubsub';

    private Client $redis;

    public function __construct(
        private PayloadGenerator $payload,
        string $redisHost,
        string $redisPort,
    ) {
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => $redisHost,
            'port' => $redisPort,
        ]);
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(function (int $count): void {
            $i = 1;
            while ($i <= $count) {
                $this->redis->publish(self::KEY, $this->payload->generateRequest());
                $i++;
            }
        }, $count);
    }
}
