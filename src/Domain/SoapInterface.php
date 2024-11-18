<?php

declare(strict_types=1);

namespace App\Domain;

interface SoapInterface
{
    public function sendMessage(string $message): string;

    public function checkStatus(string $status): string;
}