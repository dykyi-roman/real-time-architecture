<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Predis\Client;

final class RedisPubSubDomain
{
    private const KEY = 'notification-pubsub';

    /**
     * Variable
     *
     * @var PayloadGenerator |
     */
    private $payload;
    /**
     * Variable
     *
     * @var Client |
     */
    private $redis;

    /**
     * SymfonyPusherDomain constructor.
     *
     * @param PayloadGenerator $payload
     */
    public function __construct(PayloadGenerator $payload)
    {
        $this->payload = $payload;
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => $_SERVER['REDIS_HOST'],
            'port' => $_SERVER['REDIS_PORT'],
        ]);

    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        $startTime = microtime(true);

        $i = 1;
        while ($i <= $count) {
            $this->redis->publish(self::KEY, $this->payload->generateRequest());
            $i++;
        }

        return new OperationTime($startTime, microtime(true));
    }
}
