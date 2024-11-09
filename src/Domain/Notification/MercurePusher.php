<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;
use App\Domain\VO\OperationTime;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

final readonly class MercurePusher
{
    private const TOPICS = 'chat';

    public function __construct(
        private HubInterface $publisher,
        private PayloadGenerator $payload
    ) {
    }

    public function __invoke(int $count): OperationTime
    {
        return new OperationTime(function (int $count): void {
            $update = new Update(self::TOPICS, $this->payload->generateRequest());

            $i = 1;
            while ($i <= $count) {
                $this->publisher->publish($update);
                $i++;
            }
        }, $count);
    }
}
