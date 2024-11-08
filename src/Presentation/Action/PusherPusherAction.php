<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\PusherPusherDomain;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @example https://pusher.com/docs
 * @example https://dashboard.pusher.com/apps/747455/getting_started
 */
final class PusherPusherAction
{
    #[Route('/pusher/push/{count}', name: 'pusher_pusher')]
    public function __invoke(
        int $count,
        PusherPusherDomain $domain,
        NotificationJsonResponse $response,
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}