<?php

declare(strict_types=1);

namespace App\Domain;

final class PayloadGenerator
{
    /**
     * @throws \JsonException
     */
    public function generateRequest(): string
    {
        return json_encode([
            "time" => time(),
        ], JSON_THROW_ON_ERROR);
    }
}
