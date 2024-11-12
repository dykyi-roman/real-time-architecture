<?php

declare(strict_types=1);

namespace App\Domain\Message;

final readonly class KafkaMessage
{
    public function __construct(
        public string $message,
    ) {
    }
}