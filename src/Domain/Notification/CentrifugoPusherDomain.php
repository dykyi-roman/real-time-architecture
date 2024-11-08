<?php

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use App\Infrastructure\Centrifugo\CentrifugoClient;

final class CentrifugoPusherDomain
{
    /**
     * Variable
     *
     * @var PayloadGenerator |
     */
    private $payload;

    /**
     * SymfonyPusherDomain constructor.
     *
     * @param PayloadGenerator $payload
     */
    public function __construct(PayloadGenerator $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        $startTime = microtime(true);

        $host = $_SERVER['CENTRIFUGO_URL'] . ':' . $_SERVER['CENTRIFUGO_PORT'];
        $client = new CentrifugoClient($host, $_SERVER['CENTRIFUGO_API_KEY']);

        $i = 1;
        while ($i <= $count) {
            $client->publish('public', [$this->payload->generateRequest()]);
            $i++;
        }

        return new OperationTime($startTime, microtime(true));
    }
}