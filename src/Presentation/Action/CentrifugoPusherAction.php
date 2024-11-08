<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\CentrifugoPusherDomain;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CentrifugoPusherAction
{
    #[Route('/centrifugo/push/{count}', name: 'centrifugo_pusher')]
    public function __invoke(
        int $count,
        CentrifugoPusherDomain $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}