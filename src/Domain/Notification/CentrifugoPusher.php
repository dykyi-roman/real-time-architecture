<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use App\Infrastructure\Centrifugo\CentrifugoClient;

final readonly class CentrifugoPusher
{
    public function __construct(
        private PayloadGenerator $payload,
        private string $centrifugoHost,
        private string $centrifugoApiKey,
    ) {
    }

    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(
            function (int $count): void {
                $client = new CentrifugoClient($this->centrifugoHost, $this->centrifugoApiKey);

                $i = 1;
                while ($i <= $count) {
                    $client->publish('chat', [$this->payload->generateRequest()]);
                    $i++;
                }
            }, $count
        );
    }
}