<?php

namespace App\Domain\Notification;

use Predis\Client;

final class RedisTakeDomain
{
    private const KEY = 'notification';

    private const REDIS_RESPONSE_TTL = 1;

    /**
     * @return array
     */
    public function __invoke()
    {
        $redis = new Client([
            'scheme' => 'tcp',
            'host' => $_SERVER['REDIS_HOST'],
            'port' => $_SERVER['REDIS_PORT'],
        ]);

        $data = $redis->blpop([self::KEY], self::REDIS_RESPONSE_TTL);

        return $data[1] ?? [];
    }
}
