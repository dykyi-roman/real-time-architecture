<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\WebsocketPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebsocketAction
{
    #[Route('/websocket/push/{count}', name: 'websocket_pusher')]
    public function __invoke(
        int $count,
        WebsocketPusher $domain,
        NotificationJsonResponse $response,
    ): Response {
        return $response($domain($count));
    }
}
