<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use App\Domain\PayloadGenerator;

final readonly class SSEPusher
{
    public function __construct(
        private PayloadGenerator $payload,
    ) {
    }

    public function __invoke(int $count): void
    {
        if (ob_get_level() > 0) {
            ob_end_clean();
        }

        ob_start();

        for ($i = 0; $i < $count; $i++) {
            echo sprintf("data: %s\n\n", $this->payload->generateRequest());
            flush();
        }

        ob_end_flush();
    }
}