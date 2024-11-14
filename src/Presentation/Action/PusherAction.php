<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\PusherPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see https://pusher.com/docs
 * @see https://dashboard.pusher.com/apps/747455/getting_started
 */
final class PusherAction
{
    #[Route('/pusher/push/{count}', name: 'pusher_pusher')]
    public function __invoke(
        int $count,
        PusherPusher $domain,
        NotificationJsonResponse $response,
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}