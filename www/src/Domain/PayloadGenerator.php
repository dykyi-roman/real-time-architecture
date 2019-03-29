<?php

namespace App\Domain;

final class PayloadGenerator
{
    public function generateRequest(): string
    {
        return json_encode([
            "time" => time(),
        ]);
    }
}
