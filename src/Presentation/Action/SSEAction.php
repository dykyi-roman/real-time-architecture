<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\SSEPusher;
use App\Presentation\Responder\StreamResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SSEAction
{
    #[Route('/sse/push/{count}', name: 'sse_pusher')]
    public function __invoke(
        int $count,
        SSEPusher $domain,
        StreamResponse $response,
    ): Response {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        $domain($count);

        return $response;
    }
}
