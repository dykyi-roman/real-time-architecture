<?php

declare(strict_types=1);

namespace App\Presentation\Responder;

use Symfony\Component\HttpFoundation\Response;

final class StreamResponse extends Response
{
    public function __construct()
    {
        parent::__construct('', 200, ['Content-Type' => 'text/event-stream']);
    }
}