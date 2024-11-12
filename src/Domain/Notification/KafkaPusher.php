<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\KafkaProducer;
use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;

final readonly class KafkaPusher
{
    public function __construct(
        private PayloadGenerator $payload,
        private KafkaProducer $producer,
    ) {
    }

    /**
     * @param int $count
     *
     * @return OperationTime
     */
    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(
            function (int $count): void {
                $i = 1;
                while ($i <= $count) {
                    $this->producer->sendMessage('chat', $this->payload->generateRequest());
                    $i++;
                }

            }, $count
        );
    }
}
