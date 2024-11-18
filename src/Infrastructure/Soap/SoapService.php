<?php

declare(strict_types=1);

namespace App\Infrastructure\Soap;

use App\Domain\SoapInterface;

final readonly class SoapService implements SoapInterface
{
    public function sendMessage(string $message): string
    {
        return $message;
    }

    public function checkStatus(string $status): string
    {
        return "The current status is: $status";
    }
}