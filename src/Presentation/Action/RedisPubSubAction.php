<?php

declare(strict_types=1);

namespace App\Presentation\Action;

use App\Domain\Notification\RedisPusher;
use App\Presentation\Responder\NotificationJsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class RedisPubSubAction
{
    #[Route('/redis/push/{count}', name: 'redis_pusher')]
    public function __invoke(
        int $count,
        RedisPusher $domain,
        NotificationJsonResponse $response
    ): NotificationJsonResponse {
        return $response($domain($count));
    }
}
